<?php

namespace Modules\Core\Repositories\Abstracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Repositories\Interfaces\RepositoryInterface;
use Eloquent;

abstract class RepositoryAbstract implements RepositoryInterface
{

    /**
     * @param Model | Eloquent $model
     */
    public function __construct(
        protected Model|Eloquent $model
    )
    {
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @param array $with
     * @return mixed
     */
    public function all(array $with = [])
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @return Eloquent|Eloquent[]|Collection|Model|null
     */
    public function one($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $attributes
     * @return Eloquent|Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Eloquent|Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @return string|null
     */
    public function getDb()
    {
        return $this->model->getConnection()->getName();
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * @return Eloquent|Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     * @return RepositoryAbstract
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}
