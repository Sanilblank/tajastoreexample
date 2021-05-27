<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialMediaController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/')->with('success', 'Welcome To TajaMandi.');
            }
            else{
                $monthyear = date('F, Y');
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'role_id'=> 3,
                    'is_verified' => 1,
                    'monthyear'=>$monthyear,
                    'password' => Hash::make('123456dummy')
                ]);
                Auth::login($newUser);
                $newUser->notify(new NewUserNotification($newUser));
                return redirect()->intended('/')->with('success', 'You have successfully signed in with google.');
            }
        } catch (Exception $e) {
            return redirect()->route('index')->with('failure', 'You already have an account with this gmail address.');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookSignin()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $facebookId = User::where('facebook_id', $user->id)->first();

            if($facebookId){
                Auth::login($facebookId);
                return redirect()->intended('/')->with('success', 'Welcome to TajaMandi.');
            }else{
                $monthyear = date('F, Y');
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'role_id'=> 3,
                    'is_verified' => 1,
                    'monthyear'=>$monthyear,
                    'password' => Hash::make('123456dummy')
                ]);

                Auth::login($createUser);
                $createUser->notify(new NewUserNotification($createUser));
                return redirect()->intended('/')->with('success', 'You have successfully signed in with facebook.');
            }

        } catch (Exception $e) {
            return redirect()->route('index')->with('failure', 'You already have an account with this gmail address.');
        }
    }
}
