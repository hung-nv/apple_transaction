<?php
namespace App\Http\ViewComposers;

use App\Models\MenuSystem;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class SidebarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
        $menuSystem = MenuSystem::where('status', '1')->orderBy('order')->get();

        $sidebar = setMultiMenu($menuSystem);

        $route = Route::current()->getAction();

        $view->with('sidebar', $sidebar);

        $view->with('routeName', $route['as']);
    }
}