<?php

namespace ZAToday\Repository;

use ZAToday\Repository\Constracts\RepositoryInterface as Repository1;
use ZAToday\Repository\Constracts\RepositoryInterface;

abstract class Criteria {
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, Repository1 $repository);
}
