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
     * @throws \Exception
     */
    public function getOneIdApple()
    {
        $idApple = Apple::inRandomOrder()->first();
        if ($idApple) {
            $idApple->delete();
            echo $idApple->email . '|' . $idApple->password . '|' . $idApple->iphone_internal_name . '|' . $idApple->iphone_identify . '|' . $idApple->iphone_model;
        } else {
            echo 'het';
        }
    }

    /**
     * List all id apples.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $dataApples = $this->idAppleServices->getIdApples($request);

        return view('backend.apple.index', [
            'idApples' => $dataApples['idApples'],
            'fail' => $dataApples['fail'],
            'pageSize' => $dataApples['pageSize']
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
     * Delete selected id apple.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteAll(Request $request)
    {
        $this->idAppleServices->deleteSelectedIdApple($request->all());

        return response()->json([
            'url' => route('apple.index'),
            'messages' => 'You have delete successful!'
        ], 200);
    }
}
