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
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByAttributes(array $attributes)
    {
        return $this->buildQueryByAttributes($attributes)->first();
    }

    public function getByAttributes(array $attributes, string $orderBy = null, string $sortOrder = 'asc')
    {
        return $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder)->get();
    }

    private function buildQueryByAttributes(array $attributes, string $orderBy = null, string $sortOrder = 'asc')
    {
        $query = $this->model->query();

        foreach ($attributes as $field => $value) {
            $query->where($field, $value);
        }

        if ($orderBy !== null) {
            $query->orderBy($orderBy, $sortOrder);
        }
        return $query;
    }

    public function search($attributes, $limit = null)
    {
        $query = $this->buildQuery($attributes);
        if ($limit !== null)
            $query->offset(0)->limit($limit);
        return $query->get();
    }

    public function buildQuery($attributes)
    {
        $query = $this->model->query();

        foreach ($attributes as $attribute) {
            switch (count($attribute)) {
                case 2:
                    list($field, $value) = $attribute;
                    $operator = '=';
                    $boolean = 'and';
                    break;
                case 3:
                    list($field, $operator, $value) = $attribute;
                    $boolean = 'and';
                    break;
                case 4:
                    list($field, $operator, $value, $boolean) = $attribute;
                    break;
                default:
                    $field = null;
                    $operator = '=';
                    $value = null;
                    $boolean = 'and';

            }
            if ($field !== null || $value !== null)
                $query->where($field, $operator, $value, $boolean);
        }
        return $query;
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
