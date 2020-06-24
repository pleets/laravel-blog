<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        if ($user = User::where('email', $socialUser->email)->first()) {
            return $this->authAndRedirect($user);
        } else {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'avatar' => $socialUser->avatar,
            ]);

            return $this->authAndRedirect($user);
        }
    }

    /**
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authAndRedirect($user)
    {
        Auth::login($user);

        return redirect()->to('/home');
    }
}
