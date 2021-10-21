<?php

namespace Modules\Core\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Route;

class BuildCoreSidebarListener extends BuildSidebarListener
{

    public function extendWith(Menu $menu)
    {
        $menu->group(__('System'), function (Group $group) {
            $group->weight(10);
            $group->hideHeading();
            $group->item(__('Sys Management'), function (Item $item) {
                $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>');
                $item->authorize(
                    $this->checkAccess((array)[
                        'activity',
                        'horizon.index',
                        'telescope'
                    ])
                );
                $item->weight(10);
                if (Route::has('activity')) {
                    $item->item(__('Activity'), function (Item $item) {
                        $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
</svg>');
                        $item->route('activity');
                        $item->isActiveWhen(route('activity', null, false));
                        $item->authorize(
                            $this->checkAccess((array)'activity')
                        );
                        $item->isNewTab(true);
                    });
                }
                if (Route::has('horizon.index')) {
                    $item->item(__('Horizon'), function (Item $item) {
                        $item->icon('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="w-6 h-6" fill="currentColor">
<path d="M5.26176342 26.4094389C2.04147988 23.6582233 0 19.5675182 0 15c0-4.1421356 1.67893219-7.89213562 4.39339828-10.60660172C7.10786438 1.67893219 10.8578644 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15-3.716753 0-7.11777662-1.3517984-9.73823658-3.5905611zM4.03811305 15.9222506C5.70084247 14.4569342 6.87195416 12.5 10 12.5c5 0 5 5 10 5 3.1280454 0 4.2991572-1.9569336 5.961887-3.4222502C25.4934253 8.43417206 20.7645408 4 15 4 8.92486775 4 4 8.92486775 4 15c0 .3105915.01287248.6181765.03811305.9222506z"></path>
</svg>');
                        $item->route('horizon.index');
                        $item->isActiveWhen(route('horizon.index', null, false));
                        $item->authorize(
                            $this->checkAccess((array)'horizon.index')
                        );
                        $item->isNewTab(true);
                    });
                }
                if (Route::has('telescope')) {
                    $item->item(__('Telescope'), function (Item $item) {
                        $item->icon('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" class="w-6 h-6" fill="currentColor">
<path d="M0 40a39.87 39.87 0 0 1 11.72-28.28A40 40 0 1 1 0 40zm34 10a4 4 0 0 1-4-4v-2a2 2 0 1 0-4 0v2a4 4 0 0 1-4 4h-2a2 2 0 1 0 0 4h2a4 4 0 0 1 4 4v2a2 2 0 1 0 4 0v-2a4 4 0 0 1 4-4h2a2 2 0 1 0 0-4h-2zm24-24a6 6 0 0 1-6-6v-3a3 3 0 0 0-6 0v3a6 6 0 0 1-6 6h-3a3 3 0 0 0 0 6h3a6 6 0 0 1 6 6v3a3 3 0 0 0 6 0v-3a6 6 0 0 1 6-6h3a3 3 0 0 0 0-6h-3zm-4 36a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM21 28a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" class="fill-primary"></path>
</svg>');
                        $item->route('telescope');
                        $item->isActiveWhen(route('telescope', null, false));
                        $item->authorize(
                            $this->checkAccess((array)'telescope')
                        );
                        $item->isNewTab(true);
                    });
                }
            });
        });
        return $menu;
    }
}
