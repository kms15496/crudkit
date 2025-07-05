<?php

namespace Kaung\CrudKit\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SidebarComposer
{
    public function compose(View $view): void
    {
        $user = Auth::user();
        $menus = [];

        if (! $user) {
            $view->with('menus', []);
            return;
        }

        $allMenus = config('sidebar', []);

        $menus = collect($allMenus)->filter(function ($menu) use ($user) {
            return $this->userHasAccess($user, $menu);
        })->map(function ($menu) use ($user) {
            if (!empty($menu['submenu'])) {
                $menu['submenu'] = collect($menu['submenu'])->filter(function ($sub) use ($user) {
                    return $this->userHasAccess($user, $sub);
                })->values()->toArray();
            }
            return $menu;
        })->filter(function ($menu) {
            // Only keep menus that have a route or visible submenus
            return isset($menu['route']) || !empty($menu['submenu']);
        })->values()->toArray();

        $view->with('menus', $menus);
    }

    protected function userHasAccess($user, array $item): bool
    {
        // Public when nothing specified
        if (!isset($item['roles']) && !isset($item['permissions'])) {
            return true;
        }

        /* ---------- roles ---------- */
        if (isset($item['roles'])) {
            // Wildcard = visible for everyone
            if (in_array('*', $item['roles'], true)) {
                return true;
            }
            if ($user->hasAnyRole($item['roles'])) {
                return true;
            }
        }

        /* ------- permissions ------- */
        

        return false;
    }
}
