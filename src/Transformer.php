<?php

namespace ZAToday\Repository;

trait Transformer{
    /**
     * @return [type]        [description]
     */
    public function transformCollection(array $items = null)
    {
        if(!$items){
            $this->newQuery()->eagerLoadRelations();
            $items = $this->model->get()->toArray();
        }
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}
