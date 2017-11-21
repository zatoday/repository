<?php

namespace ZAToday\Repository\Console;

use Illuminate\Foundation\Console\ModelMakeCommand;

class ModelMakeCustomCommand extends ModelMakeCommand
{
    use NamespaceConsole;
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->getNamespaceApply() ?: $rootNamespace;
    }
}
