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
        $menuSystem = DB::table('menu_system')->where('status', '=', 1)->get()->toArray();
        $sidebar = setMultiMenu($menuSystem);
        $route = Route::current()->getAction();

        $view->with('sidebar', $sidebar);
        $view->with('uri', $route['as']);
    }
}