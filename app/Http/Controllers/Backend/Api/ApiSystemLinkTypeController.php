<?php

namespace App\Http\Controllers\Backend\Api;

use App\Models\SystemLinkType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiSystemLinkTypeController extends Controller
{
    public function getPostType() {
		$systemLinkType = SystemLinkType::where('type', 2)->get();
		if($systemLinkType) {
			$option = [];
			foreach ($systemLinkType as $i) {
				$option[]   = '<option value="'.$i->id.'">'.$i->name.'</option>';
			}
			$status = 200;
		} else {
			$status = 500;
		}
		return response()->json(['data' => implode('', $option)], $status);
    }
}
