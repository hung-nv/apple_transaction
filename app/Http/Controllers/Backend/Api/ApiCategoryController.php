<?php

namespace App\Http\Controllers\Backend\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiCategoryController extends Controller
{
	public function getCate() {
		$options = [];
		$check = '';
		$type = \request()->type;
		$id = \request()->id;
		$cate = Category::select(['id', 'name', 'slug', 'parent_id'])->get();

		$data = setMultiMenu($cate);

		foreach($data as $item) {
			if($id == $item->id)
				$check = "selected";

			$options[] = '<option value="'.$item->id.'" '.$check.'>'.$item->name.'</option>';
			if(isset($item->child) && $item->child) {
				foreach($item->child as $child) {
					if($id == $child->id)
						$check = "selected";
					$options[] = '<option value="'.$child->id.'" '.$check.'>-- '.$child->name.'</option>';
				}
			}
			$check = '';
		}

		$text = implode('', $options);

		echo $text;
	}
}
