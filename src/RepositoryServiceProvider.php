<?php

namespace ZAToday\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $commands = [
        'ZAToday\Repository\Console\RepositoryMakeCommand',
        'ZAToday\Repository\Console\CriteriaMakeCommand',
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
