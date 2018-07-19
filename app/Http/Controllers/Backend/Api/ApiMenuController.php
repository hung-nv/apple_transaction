<?php

namespace App\Http\Controllers\Backend\Api;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\SystemLinkType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\MenuGroup;

class ApiMenuController extends Controller {
	public function addMenu( Request $request ) {
		$name = $request->name;
		if ( MenuGroup::create( [ 'name' => $name ] ) ) {
			return response()->json( [ 'message' => 'Your menu has been created!' ], 200 );
		} else {
			return response()->json( [ 'message' => 'Fail to create menu!' ], 402 );
		}
	}

	public function getMenu( Request $request ) {
		$menu_group = $request->menu_group;
		$menus      = DB::table( 'menu' )->where( 'menu_group_id', $menu_group )->orderBy( 'order' )->get()->toArray();

		return view( 'backend.menu._menu', [
			'menus' => $menus
		] );
	}

	public function getListMenu() {
		$menuGroups = MenuGroup::all();

		return view( 'backend.menu._list_menu', [
			'menuGroups' => $menuGroups
		] );
	}

	public function destroy( Request $request ) {
		$menu = Menu::findOrFail( $request->id );
		if ( $menu->delete() ) {
			return response()->json( [ 'message' => 'Your item has been deleted!' ], 200 );
		} else {
			return response()->json( [ 'message' => 'Fail to delete this item!' ], 200 );
		}
	}

	public function updateOrder( Request $request ) {
		$data = $request->data;
		if ( count( $data ) > 0 ) {
			$this->updateMenu( $data, 0 );
		}
	}

	public function addCategory( Request $request ) {
		$ids        = $request->ids;
		$menu_group = $request->menu_group;
		$count      = 0;
		foreach ( $ids as $id ) {
			$category         = Category::findOrFail( $id );
			$data             = [
				'name'          => $category->name,
				'slug'          => $category->slug,
				'menu_group_id' => $menu_group
			];
			$system_link_type = SystemLinkType::findOrFail( $category->system_link_type_id );
			if ( $system_link_type ) {
				$data['type']                = $system_link_type->slug;
				$data['system_link_type_id'] = $system_link_type->id;
			}

			if ( Menu::create( $data ) ) {
				$count ++;
			}
		}

		return response()->json( [ 'count' => $count ], 200 );
	}

	public function addPage( Request $request ) {
		$ids        = $request->ids;
		$menu_group = $request->menu_group;
		$count      = 0;
		foreach ( $ids as $id ) {
			$page             = Post::findOrFail( $id );
			$system_link_type = SystemLinkType::findOrFail( $page->system_link_type_id );
			if ( Menu::create( [
				'name'                => $page->name,
				'slug'                => $page->slug,
				'menu_group_id'       => $menu_group,
				'type'                => $system_link_type->slug,
				'system_link_type_id' => $system_link_type->id
			] ) ) {
				$count ++;
			}
		}

		return response()->json( [ 'count' => $count ], 200 );
	}

	public function addCustom( Request $request ) {
		$name       = $request->label;
		$url        = $request->url;
		$menu_group = $request->menu_group;
		$count      = 0;
		if ( Menu::create( [
			'name'          => $name,
			'slug'          => str_slug( $name ),
			'direct'        => $url,
			'menu_group_id' => $menu_group,
			'type'          => 'direct'
		] ) ) {
			$count ++;
		}

		return response()->json( [ 'count' => $count ], 200 );
	}

	private function updateMenu( $data, $order, $parent = null ) {
		foreach ( $data as $item ) {
			$parent_id = null;
			$menu      = Menu::findOrFail( $item['id'] );
			$menu->update( [ 'order' => $order, 'parent_id' => $parent ] );
			$order ++;
			if ( isset( $item['children'] ) && $item['children'] ) {
				$parent_id = $item['id'];
				$this->updateMenu( $item['children'], $order, $parent_id );
			}
		}
	}
}
