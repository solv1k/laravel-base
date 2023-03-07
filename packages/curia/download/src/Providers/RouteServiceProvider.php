<?php

namespace Curia\Download\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const ROUTES_FILE = __DIR__.'/../../routes/download.web.php';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->prefix('curia/download')
                ->name('curia.download.')
                ->group(self::ROUTES_FILE);
        });
    }
}
