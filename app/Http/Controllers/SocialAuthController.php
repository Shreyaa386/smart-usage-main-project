<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private const PROVIDERS = ['google', 'github'];

    public function redirect(string $provider): RedirectResponse
    {
        $this->ensureProviderEnabled($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $this->ensureProviderEnabled($provider);

        try {
            $oauthUser = Socialite::driver($provider)->user();
        } catch (\Throwable) {
            return redirect()->route('login')->with('error', 'Social sign-in was cancelled or failed. Please try again.');
        }

        $email = $oauthUser->getEmail();

        if (! $email) {
            return redirect()->route('login')->with('error', 'We could not get an email from your ' . ucfirst($provider) . ' account. Use email sign-in instead.');
        }

        $user = User::where('provider', $provider)
            ->where('provider_id', $oauthUser->getId())
            ->first();

        if (! $user) {
            $user = User::where('email', $email)->first();
        }

        if ($user) {
            $user->update([
                'name' => $oauthUser->getName() ?? $oauthUser->getNickname() ?? $user->name,
                'provider' => $provider,
                'provider_id' => (string) $oauthUser->getId(),
            ]);
        } else {
            $user = User::create([
                'name' => $oauthUser->getName() ?? $oauthUser->getNickname() ?? 'User',
                'email' => $email,
                'provider' => $provider,
                'provider_id' => (string) $oauthUser->getId(),
                'password' => Hash::make(Str::random(32)),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }

    private function ensureProviderEnabled(string $provider): void
    {
        if (! in_array($provider, self::PROVIDERS, true)) {
            abort(404);
        }

        $config = config("services.{$provider}");

        if (empty($config['client_id']) || empty($config['client_secret'])) {
            abort(503, ucfirst($provider) . ' sign-in is not configured yet.');
        }
    }
}
