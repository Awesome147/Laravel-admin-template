<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use ApiHelper;
use ChargeBee_Customer;
use App\Models\SubscriptionPurchase;
use App\Notifications\Auth\ConfirmEmail;
use Ramsey\Uuid\Uuid;
class AuthController extends Controller
{

    public $success = 200;
    public $error = 400;
    public function __construct(User $User){
        $this->user = $User;
        ApiHelper::ChargeBeeEnvironment();
    }
      public function isLogin(Request $request){
          
        $request->only('email','password');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['data'=>'','status'=>false, 'message'=>$validator->errors()->all(),'token'=>''], $this->success);            
        }else{
            $email = $request->post('email');
            $userData = $this->user->checkUser('email',$email);
            if(!empty($userData)){
                 if($userData->confirmed == 1){

                if(Hash::check($request->post('password'),$userData->password)){
                         $userData = User::find($userData->id);
                         $SubscriptionPurchase = SubscriptionPurchase::select('subscriptions.*','subscription_purchases.chargeBeeSubscriptionId')->join('subscriptions','subscriptions.id','subscription_purchases.subscriptionId')->where('userId',$userData->id)->get();
                         $userData['subscription'] = $SubscriptionPurchase;
                         $token =  $userData->createToken(env('APP_NAME'))->accessToken;
                         $userData = ApiHelper::removeNull($userData);
                       
                        return response()->json(['data'=>$userData,'status'=>true,'message'=>'User Login Successfully!','token'=>$token], $this->success);            
                 }else{
                    return response()->json(['data'=>'','status'=>false,'message'=>'Invalid Password','token'=>''], $this->success);  
                 }
                 
                 }else{
                      return response()->json(['data'=>'','status'=>false, 'message'=>'Please verify your email address.','token'=>''], $this->success); 
                 }
            }else{
                return response()->json(['data'=>'','status'=>false, 'message'=>'Invalid Email Address','token'=>''], $this->success); 
            }
        }
    }

    public function getRegisterUser(Request $request){
		$request->only('name','email','password');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:password',
        ]);

        if($validator->fails()) { 
           return response()->json(['data'=>'','status'=>false, 'message'=>$validator->errors()->all(),'token'=>''], $this->success);            
        }else{
            $newUser = new User;
            $name = $request->post('name');
            $email = $request->post('email');
			$newUser->name = $name;
            $newUser->email = $email;
              $newUser->confirmed = false;
			$newUser->password = Hash::make($request->post('password'));
            $name = !empty($name) ? explode(' ',$name) : [];
            $firstName = !empty($name[0]) ? $name[0] : '' ;
            $lastName = !empty($name[1]) ? $name[1] : '' ;
        
            try { 
                $result = ChargeBee_Customer::create([
                    "firstName" => $firstName,
                    "lastName" => $lastName,
                    "email" => $email,
                    "locale" => "fr-CA",
                    "billingAddress" => []
                ]);
               $customer = $result->customer(); 
               $newUser->customer_id = $customer->id;
               $newUser->confirmation_code = Uuid::uuid4();
               $newUser->save();
            } catch (\Throwable $th) {
                 return response()->json(['data'=>'','status'=>false,'message'=> $th->getMessage(),'token'=>''], $this->success);  
            }
           
			if(!empty($newUser->id)){
			     DB::insert('insert into users_roles (user_id, role_id) values (?, ?)', [$newUser->id, 2], $this->success);
               //  $token =  $newUser->createToken(env('APP_NAME'))->accessToken; 
                 $newUser->notify(new ConfirmEmail());
                return response()->json(['data'=>'','status'=>true,'message'=>'Please verify your email address.','token'=>''], $this->success);  
				
				}else{
                   return response()->json(['data'=>'','status'=>false,'message'=>'Something went wrong, Please try again later.','token'=>''], $this->success);  
				
			}
		}	
    }
    



}
