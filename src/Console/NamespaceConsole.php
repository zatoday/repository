<?php

namespace ZAToday\Repository\Console;

trait NamespaceConsole
{
    public function getNamespaceApply()
    {
        $basePath = explode('\\', config('auth.providers.users.model'));
        if (count($basePath, 1) <= 2 && $basePath[0] === 'App') {
            $this->error('Please change config auth.providers.users.model');
            $this->error('ex: App\Entities\User');
            die();
        }
        array_pop($basePath);
        return implode('\\', $basePath);
    }
}
