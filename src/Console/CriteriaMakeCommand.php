<?php

namespace ZAToday\Repository\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CriteriaMakeCommand extends GeneratorCommand
{
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
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }
    }

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
        if($this->option('model')){
            return $rootNamespace.'\Repositories\Criterias\\'.$this->option('model');
        }
        return $rootNamespace.'\Repositories\Criterias';
    }

        /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Create a new Criteria file with add Model class.'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the Criteria already exists.'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $class = parent::buildClass($name);
        $modelClass = str_replace('User', $this->getNameInput(),config('auth.providers.users.model'));
        if ($this->option('model')) {
            $modelClass = str_replace('User', $this->option('model'),config('auth.providers.users.model'));
        }
        $class = str_replace('DummyModelClass', $modelClass, $class);

        return $class;
    }
}
