<?php

namespace ZAToday\Repository;

trait  EagerLoading
{
    /**
     * @var bool
     */
    protected $with;

    /**
     * [with description]
     * @param  [type] $relations [description]
     * @return [type]            [description]
     */
    public function with($relations) {
        if (is_string($relations)){
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }

    protected function eagerLoadRelations() {
        if(!is_null($this->with)) {
            foreach ($this->with as $relation) {
                $this->model->with($relation);
            }
        }

        return $this;
    }


    protected function newQuery() {
        $this->model = $this->model->newQuery();
        return $this;
    }
}
