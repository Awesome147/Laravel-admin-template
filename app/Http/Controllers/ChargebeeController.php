<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ChargeBee_Environment;
use ChargeBee_Subscription;

class ChargebeeController extends Controller
{
    public function index(){
        ChargeBee_Environment::configure("hos7itsolutions-test","test_6rmlsbzaslXg9OHJADN3BYi2anfG3gta");
          $result = ChargeBee_Subscription::retrieve("AzZlq2SJz3zPsECY");
            $subscription = $result->subscription();
           print_r($subscription);
          
            $card = $result->card();
             print_r($card);
           // $invoice = $result->invoice();
          //  print_r($invoice);
           // $unbilledCharges = $result->unbilledCharges();
            // print_r($unbilledCharges);
    }
}
