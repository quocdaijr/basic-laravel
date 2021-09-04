<?php

namespace Modules\Core\Listeners;

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
        if ($this->auth !== null && (isAdmin() || $this->auth->hasAnyPermission($permissions)))
            return true;
        return false;
    }

    protected function mergeAuthorization() {

    }
}
