<?php

namespace Curia\Download\Providers;

use Curia\Download\Nova\Resources\CuriaDownload;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class NovaServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            CuriaDownload::class
        ]);
    }
}
