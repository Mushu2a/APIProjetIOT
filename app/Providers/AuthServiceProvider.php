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

            $lastname = $request->header('lastname');
            $firstname = $request->header('firstname');
            $nCarte = $request->header('nCarte');

            if ($nCarte) {

                return Utilisateur::where('nCarte', $nCarte)->first();

            } elseif ($nCarte || $lastname && $firstname) {

                $user = Utilisateur::where('lastname', $lastname)->orWhere('firstname', $firstname)->first();

                if ($user && app('hash')->check($nCarte, $user->nCarteHash)) {
                    return $user;
                }
            }

            return null;
        });
    }
}
