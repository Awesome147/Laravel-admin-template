<?php
namespace App\Helpers;
use Mail;
use PeterPetrus\Auth\PassportToken;
use Config;
use Session;
use DB;
use Str;
use App\Models\User\User;
use ChargeBee_Environment;
use Auth;
use App\Models\SubscriptionPurchase;
class ApiHelper{


    public static  function ChargeBeeEnvironment(){
        ChargeBee_Environment::configure(Config::get('chargebee.chargebee_site'),Config::get('chargebee.chargebee_key'));
    }
    //Encode Bearer Token 
    public static function encodeToken($token) { 
        $token = new PassportToken($token);
            if ($token->valid) {
                if ($token->existsValid()) {
                    $userId =  $token->user_id;
                    return $userId ;
                }
            }
    }
    

    //Remove Null value In response 
    public static function removeNull($data){
        array_walk_recursive($data, function (&$item, $key) {
            $item = null === $item ? '' : $item;
        });
        return $data;
    }


    public static function SubscriptionPurchaseCheck($sub_id){
	$userId = Auth::user()->id;

       $data = SubscriptionPurchase::where('subscriptionId',$sub_id)->where('userId',$userId)->where('chargeBeeSubscriptionId','!=','')->get()->first();
       return $data;
     
 
    }



   
 

  

  




}