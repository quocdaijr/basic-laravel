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
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
</svg>');
                    $item->route('administration.user.index');
                    $item->isActiveWhen(route('administration.user.index', null, false));
                    $item->authorize(
                        $this->checkAccess((array)'administration.user.index')
                    );
                });
                $item->item(__('Role'), function (Item $item) {
                    $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
</svg>');
                    $item->route('administration.role.index');
                    $item->isActiveWhen(route('administration.role.index', null, false));
                    $item->authorize(
                        $this->checkAccess((array)'administration.role.index')
                    );
                });
                $item->item(__('Permission'), function (Item $item) {
                    $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
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
