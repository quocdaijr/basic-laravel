<?php

namespace Modules\Core\Enums;

class CoreStatusEnum
{
    public const ACTIVE = 'active';
    public const DISABLE = 'disable';
    public const DELETED = 'deleted';

    public function __construct(
        protected $value
    )
    {

    }
}
