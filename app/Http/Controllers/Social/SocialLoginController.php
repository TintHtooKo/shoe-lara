<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider){
        // dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $socialUser = Socialite::driver($provider)->user();
        // dd($socialUser);
        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
        ], [
            'name'=> $socialUser->name,
            'nickname' => $socialUser->nickname,
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token,
            'provider' => $provider, //google or github
            'role' => 'user'
        ]);
        Auth::login($user);
        return to_route('User#Home');
    }
}
