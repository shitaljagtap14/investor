<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Laracasts\Flash\Flash;
use Mail;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */

    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);
    }

   /* protected function create(array $data)
    {
        $token = bcrypt(str_random(32));
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verification_token' => $token
        ]);

        return $user;

    }*/

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
   /* protected function registered(Request $request, $user)
    {
        Mail::send('email.verify', compact('user'), function ($msg) use ($user) {
            $msg->from('no-reply@site.com', "Site name");
            $msg->subject("Welcome to Investor");
            $msg->to($user->email, $user->name);
        });
        return redirect(url("welcome"));

    }

    public function verify(Request $request)
    {
        $token = $request->get('token');
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            $user->is_verified = TRUE;
            $user->save();
            Auth::logout();
            Flash::success('Email has been successfully verified');
            return redirect('login');
        } else {
            Flash::error('Email address is invalid!');
            return redirect()->back();
        }
    }*/
}
