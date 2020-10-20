<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        try {
            $data = Socialite::driver($provider)->user();
            dd($data);
        } catch (\Exception $e) {
            return redirect(route('login'))->with('status', $provider . 'Login failed');
        }
    }
}
