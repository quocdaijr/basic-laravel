<?php

namespace Modules\Tag\Repositories\Interfaces;

use Modules\Core\Repositories\Interfaces\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    public function saveFromNames(array $names = []);
}
