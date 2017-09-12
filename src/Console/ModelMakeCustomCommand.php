<?php

namespace ZAToday\Repository\Console;

use Illuminate\Foundation\Console\ModelMakeCommand;

class ModelMakeCustomCommand extends ModelMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('auth.providers.users.model')
                        ? str_replace('\User', '',config('auth.providers.users.model'))
                        : $rootNamespace;
    }
}
