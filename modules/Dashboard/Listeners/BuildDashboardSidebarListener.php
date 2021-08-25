<?php

namespace Modules\Dashboard\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Listeners\BuildSidebarListener;

class BuildDashboardSidebarListener extends BuildSidebarListener
{

    public function extendWith(Menu $menu)
    {
        $menu->group(__('Dashboard'), function (Group $group) {
            $group->weight(0);
            $group->hideHeading();
            $group->item(__('Dashboard'), function (Item $item) {
                $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
</svg>');
                $item->route('dashboard.index');
                $item->isActiveWhen(route('dashboard.index', null, false));
                $item->authorize(
                    $this->checkAccess((array)'dashboard.index')
                );
            });
        });
        return $menu;
    }
}
