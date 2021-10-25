<?php

namespace Modules\Core\Repositories\Interfaces;

interface ElasticsearchRepositoryInterface
{
    public function search(array $query): array;

    public function find(string|int $id): ?array;

    public function findByAttributes(array $attributes): ?array;

    public function getByAttributes(array $attributes, int $offset = 0, int $limit = 10, array $sortAttributes = []): array;

    public function create(array $data): bool;

    public function updateOrCreate(array $data, array $conditions = []): bool;

    public function update(array $data): bool;

    public function delete(array $data): bool;
}
