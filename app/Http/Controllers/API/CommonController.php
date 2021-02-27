<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionPurchase;
use App\Models\Auth\User\User;
use ApiHelper;
use ChargeBee_Plan;
use ChargeBee_Customer;
use ChargeBee_Subscription;
class CommonController extends Controller
{
    public $success = 200;
    public $error = 400;
    
    public function __construct(User $User){
        $this->user = $User;
        ApiHelper::ChargeBeeEnvironment();
    }
    public function getSubscription(Request $request){
        $token = $request->bearerToken();
        $userId =  ApiHelper::encodeToken($token);
        $userData = $this->user->checkUser('id',$userId);
        if(!empty($token)){
             if(!empty($userData)){
                    $Subscription = Subscription::all();
                        if(!empty($Subscription)){
                            return response()->json(['data'=>$Subscription,'status'=>true,'message'=>'Subscription List','token'=>''], $this->success);  
                        }else{
                            return response()->json(['data'=>'','status'=>true,'message'=>'Data Empty','token'=>''], $this->success);  
                        }
             }else{
               return response()->json(['data'=>'','status'=>false,'message'=>'Invalid Token','token'=>''], $this->success);  
             }
        }else{
             return response()->json(['data'=>'','status'=>false,'message'=>'Token Is Required','token'=>''], $this->success);  
        } 
    }



    public function getSubscriptionPurchase(Request $request){
        $token = $request->bearerToken();
        $userId =  ApiHelper::encodeToken($token);
        //Check User Id 
        $userData = $this->user->checkUser('id',$userId);
        if(!empty($token)){
             if(!empty($userData)){
                   $subscriptionId = $request->post('subscriptionId');
                   //Check Subscription Id
                    $SubscriptionData = Subscription::find($subscriptionId);
                        if(!empty($SubscriptionData)){
                             $planId = !empty($SubscriptionData->planId) ? $SubscriptionData->planId : '' ;
                             try {
                                //Retrieve a customer
                                $customerId = !empty($userData->customer_id) ? $userData->customer_id : '' ;
                                $result = ChargeBee_Customer::retrieve($userData->customer_id);
                                $customer = $result->customer();
                             
                                //Retrieve a Paln
                                $result = ChargeBee_Plan::retrieve($planeId);
                                $plan = $result->plan();
                                
                                //Create A Subscription In ChargeBee 
                                 $result = ChargeBee_Subscription::create([
                                    "planId" => $planId,
                                    "autoCollection" => "off",  
                                    "customerId" => $customerId,  
                                 ]);
                                $subscription = $result->subscription();
                                
                                //Subscription Purchase Details Save In Database 
                                $SubscriptionPurchase = new SubscriptionPurchase;
                                $SubscriptionPurchase->subscriptionId = $subscriptionId;
                                $SubscriptionPurchase->userId = $userId;
                                $SubscriptionPurchase->planId = $planId;
                                $SubscriptionPurchase->customerId = $customerId;
                                $SubscriptionPurchase->chargeBeeSubscriptionId = $subscription->id;
                                $SubscriptionPurchase->json = $subscription;
                                $SubscriptionPurchase->save();
                                return response()->json(['data'=>'','status'=>true,'message'=>'Success','token'=>''], $this->success);  

                             } catch (\Throwable $th) {
                                  return response()->json(['data'=>'','status'=>false,'message'=> $th->getMessage(),'token'=>''], $this->success);  
                             }
                            return response()->json(['data'=>'','status'=>true,'message'=>'Subscription List','token'=>''], $this->success);  
                        }else{
                            return response()->json(['data'=>'','status'=>false,'message'=>'Invalid Subscription Id','token'=>''], $this->success);  
                        }
             }else{
               return response()->json(['data'=>'','status'=>false,'message'=>'Invalid Token','token'=>''], $this->success);  
             }
        }else{
             return response()->json(['data'=>'','status'=>false,'message'=>'Token Is Required','token'=>''], $this->success);  
        } 
    }




    
   
}
