<?php

namespace App\Http\Controllers\Backend;

use App\Models\Apple;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AppleController extends Controller {
	public function download() {
		$dataStorage = Apple::select( 'apple_id' )->pluck( 'apple_id' )->toArray();
		$dataStorage = implode( "\n", $dataStorage );
		Storage::put( 'apples.txt', $dataStorage );

		return Response::download( storage_path( 'app/apples.txt' ) );
	}

	public function deleteAll() {
		Apple::truncate();

		return redirect()->route( 'apple.index' );
	}

	public function getFirstId() {
		$apple = Apple::first();
		if ( $apple ) {
			echo $apple->apple_id;
			$apple->delete();
		} else {
			echo 'Het hang';
		}
	}

	public function index( Request $request ) {
		$data = Apple::paginate( 20 );

		return view( 'backend.apple.index', [
			'data' => $data
		] );
	}

	public function destroy( $id ) {
		$apple_id = Apple::findOrFail( $id );
		if ( $apple_id->delete() ) {
			Session::flash( 'success_message', 'This apple_id has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete this apple_id' );
		}

		return redirect()->route( 'apple.index' );
	}

	public function insertDirect( $id ) {
		$apple = Apple::firstOrCreate( [ 'apple_id' => $id ] );
		if ( $apple ) {
			echo 'Insert ' . $id . ' thanh cong.';
		} else {
			echo 'Fail';
		}
	}

	public function insert() {
		return view( 'backend.apple.create' );
	}

	public function store( Request $request ) {
		$content = trim( $request->apple_ids );
		$content = explode( "\n", $content );
		$content = array_filter( $content, 'trim' ); // remove any extra \r characters left behind

		$count = 0;
		foreach ( $content as $line ) {
			if ( Apple::firstOrCreate( [ 'apple_id' => trim( $line ) ] ) ) {
				$count ++;
			}
		}

		if ( $count > 0 ) {
			Session::flash( 'success_message', 'Insert your apple ids successful' );
		}

		return redirect()->route( 'apple.insert' );
	}
}
