<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

class ViewComposerServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->composeSidebarBackend();
		View::share('detect', new Agent());
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	private function composeSidebarBackend() {
		View::composer( 'backend.layouts.sidebar', 'App\Http\ViewComposers\SidebarComposer' );
	}
}
