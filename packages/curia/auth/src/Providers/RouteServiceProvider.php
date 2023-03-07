<?php

namespace Curia\Auth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const ROUTES_FILE = __DIR__.'/../../routes/auth.api.v1.php';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1/auth')
                ->name('auth.')
                ->group(self::ROUTES_FILE);

            Route::middleware('web')
                ->prefix('auth')
                ->name('auth.')
                ->group(__DIR__.'/../../routes/auth.web.php');
        });
    }
}
