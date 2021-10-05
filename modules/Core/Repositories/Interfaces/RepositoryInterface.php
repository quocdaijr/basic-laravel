<?php

namespace Modules\Core\Repositories\Interfaces;

use Eloquent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Constants\CoreConstant;

interface RepositoryInterface
{
    /**
     * @return string|null
     */
    public function getDb(): ?string;

    /**
     * @return string
     */
    public function getTable(): string;

    /**
     * @return Model|Eloquent
     */
    public function getModel(): Model|Eloquent;

    /**
     * @param $model
     * @return $this
     */
    public function setModel($model): static;

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function pagination(int $perPage): LengthAwarePaginator;

    /**
     * @return Collection|array
     */
    public function all(): Collection|array;

    /**
     * @param int $id
     * @return Model|Collection|Eloquent|array|null
     */
    public function find(int $id): Model|Collection|Eloquent|array|null;

    /**
     * @param array $attributes
     * @return Model|Builder|null
     */
    public function findByAttributes(array $attributes): Model|Builder|null;

    /**
     * @param array $attributes
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return Collection|array
     */
    public function getByAttributes(array $attributes, string $orderBy = null, string $sortOrder = 'asc'): Collection|array;

    /**
     * @param $attributes
     * @return Builder
     */
    public function buildQuery($attributes): Builder;

    /**
     * @param $attributes
     * @param int $offset
     * @param int $limit
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return array
     */
    public function search($attributes, $offset = 0, $limit = CoreConstant::PER_PAGE_DEFAULT, string $orderBy = null, string $sortOrder = 'asc'): array;

    /**
     * @param array $attributes
     * @return Model|Eloquent
     */
    public function create(array $attributes): Model|Eloquent;

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * @param array $attributes
     * @param array $values
     * @return Model|Eloquent
     */
    public function updateOrCreate(array $attributes, array $values = []): Model|Eloquent;

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool;

}
