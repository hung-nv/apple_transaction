<?php

namespace App\Http\Controllers\Backend\Api;

use App\Services\Interfaces\ImageInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class ApiPostController extends Controller
{
	protected $image;

	public function __construct(ImageInterface $image) {
		$this->image = $image;
	}

	public function setGroup(Request $request) {
		$postId = $request->post_id;
		$groupId = $request->group_id;
		$groupName = $request->group_label;
		$post = Post::findOrFail($postId);
		$post->groups()->attach([$groupId]);

		if($post->groups->contains($groupId))
		{
			$message = 'Add to "'.$groupName.'" successful!';
			$status = 200;
		} else {
			$message = 'Fail';
			$status = 500;
		}
		return response()->json(['message' => $message], $status);
	}

	public function removeGroup(Request $request) {
		$postId = $request->post_id;
		$groupId = $request->group_id;
		$groupName = $request->group_label;
		$post = Post::findOrFail($postId);
		$post->groups()->detach([$groupId]);

		if($post->groups->contains($groupId))
		{
			$message = 'Fail';
			$status = 500;
		} else {
			$message = 'Remove from "'.$groupName.'" successful';
			$status = 200;
		}
		return response()->json(['message' => $message], $status);
	}

	public function deleteImage(Request $request) {
		$post = Post::findOrFail($request->key);
		if($post) {
			$this->image->deleteImage($post['image']);
			$post->image = '';
			$post->save();
			return response()->json([
				'message' => 'File has deleted!'
			], 200);
		}
	}
}
