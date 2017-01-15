<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
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
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),                    
        ]);
    }

    public function getFacebook() {
        return \Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback(User $user) {
        $providerUser = \Socialite::driver('facebook')->user();
        
        if($providerUser->email == null){
             $providerUser->email = $providerUser->getId().'@facebook.com';
        }
        
        $checkUser = User::where('email', $providerUser->email)->where('registered_from', 'facebook')->first();
        
        if ($checkUser) {
            Auth::login($checkUser);
            return redirect('home');
        }
        
       $user->provider_id = $providerUser->getId();
        $user->name = $providerUser->getName();
        $user->email = $providerUser->getEmail();
        $user->registered_from = 'facebook';
        $user->save();

        Auth::login($user);
        return redirect('home');
    }

    public function getTwitter() {
        return \Socialite::driver('twitter')->redirect();
    }

    public function getTwitterCallback(User $user) {
        $providerUser = \Socialite::driver('twitter')->user();
        $providerUserEmail = $providerUser->getId() . '@twitter.com';

        $checkUser = User::where('email', $providerUserEmail)->first();
        if ($checkUser) {
            Auth::login($checkUser);
            return redirect('home');
        }
        $user->provider_id = $providerUser->getId();
        $user->name = $providerUser->getName();
        $user->email = $providerUserEmail;
        $user->registered_from = 'twitter';
        $user->save();

        Auth::login($user);
        return redirect('home');
    }

    public function getGoogle() {
        return \Socialite::driver('google')->redirect();
    }

    public function getGoogleCallback(User $user) {
        $providerUser = \Socialite::driver('google')->user();
       
        if($providerUser->email == null){
             $providerUser->email = $providerUser->getId().'@google.com';
        }
        
        $checkUser = User::where('email', $providerUser->email)->where('registered_from', 'google')->first();
       
        if ($checkUser) {
            Auth::login($checkUser);
            return redirect('home');
        }
        $user->provider_id = $providerUser->getId();
        $user->name = $providerUser->getName();
        $user->email = $providerUser->getEmail();
        $user->registered_from = 'google';
        $user->save();

        Auth::login($user);
        return redirect('home');
    }
    
    public function getGoodreads() {
        
        return \Socialite::with('goodreads')->redirect();
               

    }
    
    public function getGoodreadsCallback(User $user) {  
        
         $providerUser = \Socialite::driver('goodreads')->user();
        
         
        if($providerUser->email == null){
             $providerUser->email = $providerUser->getId().'@goodreads.com';
        }
        
        $checkUser = User::where('email', $providerUser->email)->where('registered_from', 'goodreads')->first();
       
        if ($checkUser) {
            Auth::login($checkUser);
            return redirect('home');
        }
        $user->provider_id = $providerUser->getId();
        $user->name = $providerUser->getName();
        $user->email = $providerUser->getEmail();
        $user->registered_from = 'goodreads';
        $user->save();

        Auth::login($user);
        return redirect('home');
        
    }
}
