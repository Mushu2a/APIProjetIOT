<?php

namespace App\Providers;

use App\Utilisateur;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            $lastname = ucfirst($request->header('lastname'));
            $firstname = ucfirst($request->header('firstname'));
            $email = $request->header('email');
            $password = $request->header('password');
            $card = $request->header('card');

            if ($card) {

                $user = Utilisateur::where('nCarte', $card)->first();

                return $user;

            } elseif ($lastname && $firstname && $password) {

                $user = Utilisateur::where('lastname', $lastname)->where('firstname', $firstname)->first();

                if ($user && app('hash')->check($password, $user->password)) {
                    return $user;
                }

            } elseif ($email && $password) {

                $user = Utilisateur::where('email', $email)->first();

                if ($user && app('hash')->check($password, $user->password)) {
                    return $user;
                }

            } elseif ($password == "JSAC") {

                $user = Utilisateur::where('isAdmin', 1)->first();

                if ($user && app('hash')->check($password, $user->password)) {
                    return $user;
                }
            }

            return null;
        });
    }
}
