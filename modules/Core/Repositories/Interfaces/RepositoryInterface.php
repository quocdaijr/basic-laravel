<?php

namespace Modules\Core\Repositories\Interfaces;

interface RepositoryInterface
{
    public function getDb();

    public function getTable();

    public function getModel();

    public function setModel($model);

    public function pagination(int $perPage);

    public function all();

    public function find(int $id);

    public function findByAttributes(array $attributes);

    public function getByAttributes(array $attributes, string $orderBy = null, string $sortOrder = 'asc');

    public function buildQuery($attributes);

    public function search($attributes, $limit = null);

    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function updateOrCreate(array $attributes, array $values = []);

    public function delete(int $id);

}
