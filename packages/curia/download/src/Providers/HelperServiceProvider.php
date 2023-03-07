<?php

namespace Curia\Download\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public const HELPERS_FILE = __DIR__.'/../../helpers/helpers.php';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        require_once self::HELPERS_FILE;
    }
}
