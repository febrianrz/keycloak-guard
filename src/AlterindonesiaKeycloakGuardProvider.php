<?php

namespace Alterindonesia\KeycloakGuard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AlterindonesiaKeycloakGuardProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/../config/keycloak.php' => config_path('keycloak.php')], 'config');
        $this->mergeConfigFrom(__DIR__.'/../config/keycloak.php', 'keycloak');

    }

    public function register()
    {
        Auth::extend('keycloak', function ($app, $name, array $config) {
            return new KeycloakGuard(
                Auth::createUserProvider($config['provider']),
                $app->request
            );
        });
    }

}
