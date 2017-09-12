<?php

namespace ZAToday\Repository;

use Illuminate\Support\ServiceProvider;
use ZAToday\Repository\Console\ModelMakeCustomCommand;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * List commands
     * @var array
     */
    protected $commands = [
        'ZAToday\Repository\Console\RepositoryMakeCommand',
        'ZAToday\Repository\Console\CriteriaMakeCommand',
        'ZAToday\Repository\Console\ModelMakeCustomCommand',
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ModelMakeCustomCommand::class];
    }
}
