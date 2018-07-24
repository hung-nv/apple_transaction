<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\IdAppleStore;
use App\Models\Apple;
use App\Services\IdAppleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppleController extends Controller
{

    protected $idAppleServices;

    public function __construct(IdAppleServices $services)
    {
        parent::__construct();
        $this->idAppleServices = $services;
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

    /**
     * Delete id apple
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->idAppleServices->deleteIdApple($id);

        return redirect()->route('apple.index')->with(['success_message' => 'Delete successful']);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        Apple::truncate();

        return redirect()->route('apple.index');
    }
}
