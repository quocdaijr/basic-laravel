<?php

namespace Modules\Core\Listeners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Sidebar\SidebarExtender;
use Modules\Core\Events\BuildSidebarEvent;

abstract class BuildSidebarListener implements SidebarExtender
{
    protected $auth;

    public function __construct(
    )
    {
        $this->auth =  Auth::user();
    }

    /**
     * @param BuildSidebarEvent $sidebar
     */
    public function handle(BuildSidebarEvent $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    protected function checkAccess($permissions = []){
        if (Auth::user() !== null && Auth::user()->hasAnyPermission($permissions))
            return true;
        return false;
    }

    protected function mergeAuthorization() {

    }
}
