<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\LogParsers\Visits;
use App\Services\LogParsers\UniqueVisits;

/**
 * Register logparser service
 */
class LogParserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Visits::class);
        $this->app->singleton(UniqueVisits::class);
        $this->app->tag([Visits::class, UniqueVisits::class], 'LogParsers');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['LogParsers'];
    }
}
