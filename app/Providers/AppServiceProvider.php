<?php

namespace App\Providers;

use App\Domain\User\User;
use Illuminate\Support\ServiceProvider;
use \Auth0\Login\Contract\Auth0UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Auth0UserRepository::class,User::class);
    }
}
