<?php

namespace Modules\Core\Exceptions;

use RuntimeException;

class TraitMissingModelException extends RuntimeException
{
    protected $message = 'The "$this" property must instance of \Illuminate\Database\Eloquent\Model.';
}
