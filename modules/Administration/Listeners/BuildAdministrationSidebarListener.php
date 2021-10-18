<?php

namespace Modules\Administration\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Listeners\BuildSidebarListener;

class BuildAdministrationSidebarListener extends BuildSidebarListener
{
    public function extendWith(Menu $menu)
    {
        $menu->group(__('System'), function (Group $group) {
            $group->weight(10);
            $group->hideHeading();
            $group->item(__('Management'), function (Item $item) {
                $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
</svg>');
                $item->isActiveWhen(route('administration.user.index', null, false));
                $item->authorize(
                    $this->checkAccess((array)[
                        'administration.user.index',
                        'administration.role.index',
                        'administration.permission.index',
                    ])
                );
                $item->item(__('User'), function (Item $item) {
                    $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
</svg>');
                    $item->route('administration.user.index');
                    $item->isActiveWhen(route('administration.user.index', null, false));
                    $item->authorize(
                        $this->checkAccess((array)'administration.user.index')
                    );
                });
                $item->item(__('Role'), function (Item $item) {
                    $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
</svg>');
                    $item->route('administration.role.index');
                    $item->isActiveWhen(route('administration.role.index', null, false));
                    $item->authorize(
                        $this->checkAccess((array)'administration.role.index')
                    );
                });
                $item->item(__('Permission'), function (Item $item) {
                    $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
</svg>');
                    $item->route('administration.permission.index');
                    $item->isActiveWhen(route('administration.permission.index', null, false));
                    $item->authorize(
                        $this->checkAccess((array)'administration.permission.index')
                    );
                });
            });
        });
        return $menu;
    }
}
