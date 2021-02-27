<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionPurchase;
use Crypt;
use Auth;
use App\Models\Auth\User\User;
use ChargeBee_Plan;
use ChargeBee_Customer;
use ChargeBee_Environment;
use ChargeBee_Subscription;
use ChargeBee_Address;
use ApiHelper;
use Config;
use Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        ApiHelper::ChargeBeeEnvironment();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function subscription(){
        $data = Subscription::all();
             return view('subscription',['data'=>$data]);
    }

    public function subscriptionPay($token){
        $id = $token;
    /// $id =  Crypt::decrypt($token);
       $SubscriptionData = Subscription::find($id);
       $userId = Auth::user()->id;
       $data['id'] = $id;
       $data['user'] = User::find($userId);
        return view('payment',$data);
    }


    public function payment(Request $req){

        ChargeBee_Environment::configure(Config::get('chargebee.chargebee_site'),Config::get('chargebee.chargebee_key'));
        $subscription_id = $req->post('subscription_id');
       // $subscription_id = 1;
        $SubscriptionData = Subscription::find($subscription_id);
      
        $userId = $userId = Auth::user()->id;
        $userData = User::find($userId);
        $planId = !empty($SubscriptionData->planId) ? $SubscriptionData->planId : '' ;
    
         $customerId = !empty($userData->customer_id) ? $userData->customer_id : '' ;
      //  if ($_POST) {
          //  validateParameters($_POST);
            try {
                 $postCustomer = $req->customer;
                  
                $ChargeBee_Subscription = ChargeBee_Subscription::create([
                      "planId" => $planId,
                      "customer" => $req->post('customer'),
                      "card" => array(
                        "tmp_token" => $req->post('stripeToken'),
                     )  
                ]);
                $s = $ChargeBee_Subscription->subscription();
              //  print_r( $s);
               ///$customer =$s->customer();
                $ChargeBee_Address = ChargeBee_Address::update(array(
                    "subscription_id" => $s->id,
                    "label" => "shipping_address",
                    "first_name" => $postCustomer['first_name'],
                    "last_name" => $postCustomer['last_name'],
                    "addr" => $req->post('addr'),
                    "extended_addr" => $req->post('extended_addr'),
                    "city" => $req->post('city'),
                    "state" => $req->post('state'),
                    "zip" => $req->post('zip_code')
                ));
                $ChargeBee_Address = $ChargeBee_Address->address();
               
                $jsonResp = array();
                
                /*
                * Forwarding to success page after successful create subscription in ChargeBee.
                */
                $SubscriptionPurchase = new SubscriptionPurchase;
                $SubscriptionPurchase->subscriptionId =  $subscription_id;
                $SubscriptionPurchase->userId = $userId;
                $SubscriptionPurchase->planId = $planId;
                $SubscriptionPurchase->customerId = $customerId;
                $SubscriptionPurchase->chargeBeeSubscriptionId = $s->id;
                $SubscriptionPurchase->json = '';
                $SubscriptionPurchase->save();
                $queryParameters = "name=" . urlencode($postCustomer['first_name']) .
                            "&planId=" . urlencode($ChargeBee_Subscription->subscription()->planId);        
                $jsonResp["forward"] = url('thankyou');
                echo json_encode($jsonResp, true);
                
            } catch(ChargeBee_PaymentException $e) {
                print_r($e);
                handleTempTokenErrors($e);
            } catch(ChargeBee_InvalidRequestException $e) {
                print_r($e);
                echo 'here';
                handleInvalidRequestErrors($e, "plan_id");
            } catch(Exception $e) {
                print_r($e);
                echo 'there';
                handleGeneralErrors($e);
            }
       // }

    }


    public function isGetprofile(Request $request){
         $userId = Auth::user()->id;
         $userData = User::find($userId);
         if($request->isMethod('post')){
                $this->validate($request, [
                    'name' => 'required',
                ]);

                $userData->name = $request->name;
                $userData->save();
                redirect('profile')->with('profilemessage','Profile Update Successfully');
         }
        return view('auth.profile',['data' =>$userData]);
    }
   


        //Change Password 
    public function isGetchangePassword(Request $request){
        $loginid = Auth::user()->id;
        $userData = User::find($loginid);
        $request->only('current_password','password','confirm_password');
        if($request->isMethod('post')){
            $request->validate([
                'current_password' => 'required|string|min:6',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|string|min:6|same:password',
            ]);
           
            if(!empty($userData)){
                if(Hash::check($request->post('current_password'),$userData->password)){
                 $userData->password =  Hash::make($request->post('password_confirmation'));
            
                 $userData->save();
              

                return redirect("change-password")->with('change_pass_message' ,'Password Update Successfully!');
                }else{
  
                    return redirect("change-password")->with('change_pass_message_error' , 'Current Password Invalid!');
                }
             }else{
                
                return redirect("/");
             }

        }
        return view('auth.profile');
    }


      public function isGetAccountDeleteAccount(Request $request){
        $loginid = Auth::user()->id;
        $userData = User::find($loginid);
      
        if($request->isMethod('post')){
            $request->validate([
                'password' => 'required',
            ]);
           
            if(!empty($userData)){
                if(Hash::check($request->post('password'),$userData->password)){
                   $customerId = $userData->customer_id;
                   $SubscriptionPurchaseData = SubscriptionPurchase::where('userId',$userData->id)->get();
                   if(!empty($SubscriptionPurchaseData)){
                         foreach($SubscriptionPurchaseData as $key => $value) {
                               $subscriptionData =  Subscription::find($value->subscriptionId);
                                $type = !empty($subscriptionData->type) ? $subscriptionData->type : '' ;
                                $number = !empty($subscriptionData->number) ? $subscriptionData->number : '' ;
                                $created_at = !empty($value->created_at) ? $value->created_at : '' ;
                                if($type == "week"){
                                    $type = "weeks";
                                }else if($type == "day"){
                                    $type = "days";
                                }else if($type == "month"){
                                    $type = "months";
                                }else{
                                        $type = "years";
                                }
                                $d = strtotime("+".$number."  ".$type."",strtotime($created_at));
                                $expires =  date("F d, Y",$d); 

                                if(strtotime($expires) >= strtotime(date('F d,Y'))){
                                    $chargeBeeSubscriptionId = !empty($value->chargeBeeSubscriptionId) ? $value->chargeBeeSubscriptionId : '' ;
                                    if(!empty($chargeBeeSubscriptionId)){
                                        try {
                                           $result = ChargeBee_Subscription::cancel($chargeBeeSubscriptionId,array(
                                                "endOfTerm" => true
                                            ));
                                        } catch (\Throwable $th) {
                                           
                                        }
                                          
                                    }
                                }
                         }
                   }
                    $userData->delete();
                     Auth::logout();
                     $request->session()->flush();
                    return redirect("/");
                 return redirect("change-password")->with('delete_account_message' ,'Password Update Successfully!');
                }else{
  
                    return redirect("change-password")->with('delete_account_message_error' , 'Password Invalid!');
                }
             }else{
                
                return redirect("/");
             }

        }
        return view('auth.profile');
    }
    
}
