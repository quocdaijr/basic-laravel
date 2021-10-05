<?php

namespace Modules\Core\Views\Components;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\Append;
use Maatwebsite\Sidebar\Badge;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Presentation\ActiveStateChecker;
use Maatwebsite\Sidebar\Presentation\Illuminate\IlluminateSidebarRenderer;
use Maatwebsite\Sidebar\Sidebar;
use Modules\Core\Constants\CoreConstant;

class SidebarRenderer extends IlluminateSidebarRenderer
{

    protected $folderView = 'core::components.sidebar.';

    /**
     * @param Sidebar $sidebar
     *
     * @return View
     */
    public function render(Sidebar $sidebar, $layouts = [CoreConstant::LAYOUT_PC, CoreConstant::LAYOUT_MOBILE])
    {
        $menu = $sidebar->getMenu();

        if ($menu->isAuthorized()) {
            $groups = [];
            $mobile_groups = [];
            foreach ($menu->getGroups() as $group) {
                $groups[] = $this->renderGroup($group);
                $mobile_groups[] = $this->renderGroup($group, CoreConstant::LAYOUT_MOBILE);
            }

            return $this->factory->make($this->folderView . 'menu', [
                'groups' => $groups,
                'mobile_groups' => $mobile_groups
            ]);
        }
    }

    private function renderGroup(Group $group, $layout = CoreConstant::LAYOUT_PC)
    {
        if ($group->isAuthorized()) {
            $items = [];
            foreach ($group->getItems() as $item) {
                $items[] = $this->renderItem($item, $layout);
            }

            return $this->factory->make($this->folderView . 'group', [
                'group' => $group,
                'items' => $items,
                'layout' => $layout
            ])->render();
        }
    }

    private function renderItem(Item $item, $layout = CoreConstant::LAYOUT_PC, $level = 0)
    {
        if ($item->isAuthorized()) {
            $items = [];
            foreach ($item->getItems() as $child) {
                $items[] = $this->renderItem($child, $layout, $level + 1);
            }

            $badges = [];
            foreach ($item->getBadges() as $badge) {
                $badges[] = $this->renderBadge($badge, $layout);
            }

            $appends = [];
            foreach ($item->getAppends() as $append) {
                $appends[] = $this->renderAppend($append, $layout);
            }

            $view = $this->folderView . ($level == 0 ? 'item' : 'item');
            return $this->factory->make($view, [
                'item' => $item,
                'items' => $items,
                'badges' => $badges,
                'appends' => $appends,
                'active' => (new ActiveStateChecker())->isActive($item),
                'layout' => $layout
            ])->render();
        }
    }

    private function renderBadge(Badge $badge, $layout = CoreConstant::LAYOUT_PC)
    {
        if ($badge->isAuthorized()) {
            return $this->factory->make($this->folderView . 'badge', [
                'badge' => $badge,
                'layout' => $layout
            ])->render();
        }
    }

    private function renderAppend(Append $append, $layout = CoreConstant::LAYOUT_PC)
    {
        if ($append->isAuthorized()) {
            return $this->factory->make($this->folderView . 'append', [
                'append' => $append,
                'layout' => $layout
            ])->render();
        }
    }


}
