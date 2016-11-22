<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
  

    public function getFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback(User $user)
    {
        $providerUser = Socialite::driver('facebook')->user();
        $checkUser = User::where('email', $providerUser->email)->first();
        if($checkUser){
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
    
      public function getTwitter()
    {
        return socialite::driver('twitter')->redirect();
    }
    
    public function getTwitterCallback(User $user)
    {
        $providerUser = Socialite::driver('twitter')->user();
        $checkUser = User::where('email', $providerUser->email)->first();
        if($checkUser){
            Auth::login($checkUser);
            return redirect('home');
        }   
            $user->provider_id = $providerUser->getId();
            $user->name = $providerUser->getName();
            $user->email = $providerUser->getEmail();
            $user->registered_from = 'twitter';
            $user->save();
            
            Auth::login($user);
            return redirect('home');
    }
    
       public function getGoogle()
    {
        return socialite::driver('google')->redirect();
    }
    
    public function getGoogleCallback(User $user)
    {
        $providerUser = Socialite::driver('google')->user();
        $checkUser = User::where('email', $providerUser->email)->first();
        if($checkUser){
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
}
