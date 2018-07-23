<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\IdAppleStore;
use App\Models\Apple;
use App\Services\IdAppleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AppleController extends Controller
{

    protected $idAppleServices;

    public function __construct(IdAppleServices $services)
    {
        parent::__construct();
        $this->idAppleServices = $services;
    }


    public function download()
    {
        $dataStorage = Apple::select('apple_id')->pluck('apple_id')->toArray();
        $dataStorage = implode("\n", $dataStorage);
        Storage::put('apples.txt', $dataStorage);

        return Response::download(storage_path('app/apples.txt'));
    }

    public function deleteAll()
    {
        Apple::truncate();

        return redirect()->route('apple.index');
    }

    /**
     * List all id apples.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $idApples = Apple::orderByDesc('created_at')->paginate(20);

        return view('backend.apple.index', [
            'data' => $idApples
        ]);
    }

    public function destroy($id)
    {
        $apple_id = Apple::findOrFail($id);
        if ($apple_id->delete()) {
            Session::flash('success_message', 'This apple_id has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete this apple_id');
        }

        return redirect()->route('apple.index');
    }

    /**
     * Create id apple.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.apple.create');
    }

    /**
     * Store id apples.
     * @param IdAppleStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IdAppleStore $request)
    {
        $response = $this->idAppleServices->createIdApple($request->all());

        return redirect()->route('apple.index')->with($response);
    }
}
