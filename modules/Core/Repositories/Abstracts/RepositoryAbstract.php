<?php

namespace Modules\Core\Repositories\Abstracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Constants\CoreConstant;
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
    public function pagination(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->orderBy('id', 'desc')->paginate($perPage);
    }

    /**
     * @param array $with
     * @return Collection|array
     */
    public function all(array $with = []): Collection|array
    {
        return $this->model->get();
    }

    /**
     * @param $id
     * @return Model|Collection|Eloquent|array|null
     */
    public function find($id): Model|Collection|Eloquent|array|null
    {
        return $this->model->find($id);
    }

    /**
     * @param array $attributes
     * @return Model|Builder|null
     */
    public function findByAttributes(array $attributes): Model|Builder|null
    {
        return $this->buildQueryByAttributes($attributes)->first();
    }

    /**
     * @param array $attributes
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return Collection|array
     */
    public function getByAttributes(array $attributes, string $orderBy = null, string $sortOrder = 'asc'): Collection|array
    {
        return $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder)->get();
    }

    /**
     * @param array $attributes
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return Builder
     */
    private function buildQueryByAttributes(array $attributes, string $orderBy = null, string $sortOrder = 'asc'): Builder
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

    /**
     * @param $attributes
     * @param int $offset
     * @param int $limit
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return array
     */
    public function search($attributes, $offset = 0, $limit = CoreConstant::PER_PAGE_DEFAULT, string $orderBy = null, string $sortOrder = 'asc'): array
    {
        $query = $this->buildQuery($attributes);
        $total = $query->count();
        if ($orderBy !== null)
            $query->orderBy($orderBy, $sortOrder);
        $data = $query->offset($offset)->limit($limit)->get();

        return [
            'totalItems' => $total,
            'totalPages' => ceil($total / $limit),
            'data' => $data
        ];
    }

    /**
     * @param $attributes
     * @return Builder
     */
    public function buildQuery($attributes): Builder
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
     * @return Model|Eloquent
     */
    public function create(array $attributes): Model|Eloquent
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Eloquent|Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model|Eloquent
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @return string|null
     */
    public function getDb(): ?string
    {
        return $this->model->getConnection()->getName();
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->model->getTable();
    }

    /**
     * @return Eloquent|Model
     */
    public function getModel(): Model|Eloquent
    {
        return $this->model;
    }

    /**
     * @param $model
     * @return RepositoryAbstract
     */
    public function setModel($model): static
    {
        $this->model = $model;
        return $this;
    }
}
