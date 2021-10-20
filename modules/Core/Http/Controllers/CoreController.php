<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Route;

class CoreController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                toast(session('success'), 'success');
            }

            if (session('error')) {
                toast(session('error'), 'error');
            }
            return $next($request);
        });

        /**
         * Middleware used to write activity log
         * More at package: jeremykenedy/laravel-logger
        */
        if (Route::hasMiddlewareGroup('activity'))
            $this->middleware('activity');
    }
}
