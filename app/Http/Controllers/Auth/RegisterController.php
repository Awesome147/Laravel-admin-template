<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Role\Role;
use App\Notifications\Auth\ConfirmEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\Auth\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Ramsey\Uuid\Uuid;
use ChargeBee_Customer;
use ApiHelper;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        ApiHelper::ChargeBeeEnvironment();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'register_name' => 'required|max:255',
            'register_email' => 'required|email|max:255|unique:users,email',
            'register_password' => 'required|min:6|confirmed',
        ];

        if (config('auth.captcha.registration')) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        /** @var  $user User */
        $user = User::create([
            'name' => $data['register_name'],
            'email' => $data['register_email'],
            'password' => bcrypt($data['register_password']),
            'confirmation_code' => Uuid::uuid4(),
            'confirmed' => false
        ]);
        $name = !empty($data['name']) ? explode(' ',$data['name']) : [];
        $firstName = !empty($name[0]) ? $name[0] : '' ;
        $lastName = !empty($name[1]) ? $name[1] : '' ;
        try { 
            $result = ChargeBee_Customer::create([
                "firstName" => $firstName,
                "lastName" => $lastName,
                "email" => $data['register_email'],
                "locale" => "fr-CA",
                "billingAddress" => []
            ]);
           $customer = $result->customer(); 
           $userData = User::find($user->id);
           $userData->customer_id = $customer->id;
           $userData->save();
           
        } catch (\Throwable $th) {
          //   return response()->json(['data'=>'','status'=>false,'message'=> $th->getMessage(),'token'=>''], $this->success);  
        }
        if (config('auth.users.default_role')) {
            $user->roles()->attach(Role::firstOrCreate(['name' => config('auth.users.default_role')]));
        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if (config('auth.users.confirm_email') && !$user->confirmed) {

            $this->guard()->logout();

            $user->notify(new ConfirmEmail());

            return redirect(url('/'));
        }
    }
}
