<?php

namespace ZAToday\Repository\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use ZAToday\Repository\Console\NamespaceConsole;

class CriteriaMakeCommand extends GeneratorCommand
{
    use NamespaceConsole;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:criteria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Criteria class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Criteria';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/criteria.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return ($this->getNamespaceApply() ?: $rootNamespace).'\Criteria';
    }
}
