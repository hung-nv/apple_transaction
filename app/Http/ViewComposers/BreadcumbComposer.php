<?php
namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class BreadcumbComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
    	$text = '';
    	$slug = '';
	    if(Route::current()->slug) {
	    	$slug = Route::current()->slug;
		    $action = Route::current()->getAction();
		    if($action['as'] == 'news.category') {
			    $text = Category::where('slug', Route::current()->slug)->first()->name;
		    } else {
			    $text = Post::where('slug', Route::current()->slug)->first()->name;
		    }
	    } else if(request()->txtSearch) {
			$text = request()->txtSearch;
	    }

        $view->with('text', $text);
	    $view->with('slug', $slug);
    }
}