<?php

namespace App\Http\Controllers\Backend;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CreditCardController extends Controller {
	public function download() {
		$dataStorage = CreditCard::select( 'number' )->pluck( 'number' )->toArray();
		$dataStorage = implode( "\n", $dataStorage );
		Storage::put( 'creditcards.txt', $dataStorage );

		return Response::download( storage_path( 'app/creditcards.txt' ) );
	}

	public function deleteAll() {
		CreditCard::truncate();

		return redirect()->route( 'creditCard.index' );
	}

	public function getFirstNumber() {
		$credit = CreditCard::first();
		if ( $credit ) {
			echo $credit->number;
			$credit->delete();
		} else {
			echo 'Het hang';
		}
	}

	public function create() {
		return view( 'backend.creditcard.create' );
	}

	public function insertDirect( $number ) {
		if ( ! empty( $number ) ) {
			$credit = CreditCard::create( [ 'number' => $number ] );
			if ( $credit ) {
				echo 'Insert ' . $number . ' thanh cong.';
			} else {
				echo 'Fail';
			}
		}
	}

	public function store( Request $request ) {
		$content = trim( $request->credit_cards );
		$content = explode( "\n", $content );
		$content = array_filter( $content, 'trim' ); // remove any extra \r characters left behind

		$count = 0;
		foreach ( $content as $line ) {
			if ( CreditCard::firstOrCreate( [ 'number' => trim( $line ) ] ) ) {
				$count ++;
			}
		}

		if ( $count > 0 ) {
			Session::flash( 'success_message', 'Insert your credit cards successful' );
		}

		return redirect()->route( 'creditCard.create' );
	}

	public function index( Request $request ) {
		$data = CreditCard::paginate( 20 );

		return view( 'backend.creditcard.index', [
			'data' => $data
		] );
	}

	public function destroy( $id ) {
		$credit = CreditCard::findOrFail( $id );
		if ( $credit->delete() ) {
			Session::flash( 'success_message', 'This credit has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete this credit' );
		}

		return redirect()->route( 'creditCard.index' );
	}
}
