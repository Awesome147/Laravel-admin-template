<?php

namespace App\Http\Controllers\Admin;



use App\Models\Auth\User\User;
use App\Models\SubscriptionPurchase;
use Illuminate\Http\Request;

class PermissionController
{
    public function index(Request $request)
    {
        $data = [];
        $users = User::select('users.*')->join('users_roles','users.id','users_roles.user_id')->where('users_roles.role_id',2)->sortable(['email' => 'desc'])->paginate(10);
         
        if(!empty($users)){
             foreach ($users as $key => $value) {
                  
                  $SubscriptionPurchase = SubscriptionPurchase::select('subscriptions.*','subscription_purchases.chargeBeeSubscriptionId','subscription_purchases.created_at as purchases_date')->join('subscriptions','subscriptions.id','subscription_purchases.subscriptionId')->where('userId',$value->id)->get()->toArray();
                  $data[] = [
                       'name'=>$value->name,
                        'email'=>$value->email,
                         'id'=>$value->id,
                          'subscriptionPurchase'=>$SubscriptionPurchase,
                  ];
                }
        }
       
        return view('admin.permissions', ['users' => $users,'data'=>$data]);
    }

    public function repeat(User $user, Request $request)
    {
        $protectionValidation = protection_validate($user);

        if ($request->expectsJson()) return response($protectionValidation->toArray());

        return redirect()->back();
    }
}
