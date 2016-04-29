<?php namespace App\Providers;

use Auth;
use App\User;
use App\Auth\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::provider('custom', function($app) {
            return new CustomUserProvider(new User);
        });
    }

    public function register()
    {

    }
}