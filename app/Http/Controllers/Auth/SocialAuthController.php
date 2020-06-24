<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        if ($request->has('error')) {
            redirect()->route('login')
                ->withErrors([
                    'socialite' => $request->get('error') .
                        $request->get('error_description', 'unknown') .
                        $request->get('error_reason', 'No reason'),
                ]);
        }

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
