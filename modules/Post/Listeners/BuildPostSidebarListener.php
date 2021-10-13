<?php

namespace Modules\Post\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Listeners\BuildSidebarListener;

class BuildPostSidebarListener extends BuildSidebarListener
{
    public function extendWith(Menu $menu)
    {
        $menu->group(__('Archive'), function (Group $group) {
            $group->weight(1);
            $group->hideHeading();
            $group->item(__('Archive'), function (Item $item) {
                $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
</svg>');
                if (!$item->hasItems()) {
                    $item->authorize(
                        $this->checkAccess((array)'post.index')
                    );
                } else {
                    $item->authorize(
                        $item->isAuthorized() || $this->checkAccess((array)'post.index')
                    );
                }
                $item->item(__('Post'), function (Item $item) {
                    $item->icon('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
</svg>');
                    $item->route('post.index');
                    $item->isActiveWhen(route('post.index', null, false));
                    $item->authorize(
                        $this->checkAccess((array)'post.index')
                    );
                    $item->weight(1);
                });
            });
        });
        return $menu;
    }
}
