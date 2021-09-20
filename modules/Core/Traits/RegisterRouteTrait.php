<?php

namespace Modules\Core\Traits;

use Illuminate\Support\Facades\Route;

trait RegisterRouteTrait
{
    public function registerApiRoute($moduleName, $controllerNamespace) {
        if (config('modules.api_url') !== null) {
            Route::domain(config('modules.api_url'))
                ->middleware(['api'])
                ->namespace($controllerNamespace)
                ->group(module_path($moduleName, '/Routes/api.php'));
        } else {
            Route::prefix('api')
                ->middleware(['api'])
                ->namespace($controllerNamespace)
                ->group(module_path($moduleName, '/Routes/api.php'));
        }
    }
}
