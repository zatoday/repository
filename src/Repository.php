<?php

namespace ZAToday\Repository;

use ZAToday\Repository\Criteria;
use Illuminate\Support\Collection;
use ZAToday\Repository\EagerLoading;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use ZAToday\Repository\CriteriaRepository;
use ZAToday\Repository\Constracts\RepositoryInterface;
use ZAtoday\Repository\Exceptions\RepositoryException;

abstract class Repository extends CriteriaRepository implements RepositoryInterface {
    use EagerLoading;
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @param App $app
     * @throws Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app, Collection $collection) {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public abstract function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model){
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model->newQuery();
    }

    public function all($columns = array('*'))
    {
        $this->applyCriteria();
        $this->newQuery()->eagerLoadRelations();
        return $this->model->get($columns);
    }

    public function get($columns = array('*'))
    {
        $this->applyCriteria();
        $this->newQuery()->eagerLoadRelations();
        return $this->model->get($columns);
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->newQuery()->eagerLoadRelations();
        return $this->model->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->newQuery()->eagerLoadRelations();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
}
