<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\SerialServices;
use App\Http\Requests\SerialStore;

class SerialController extends Controller
{
    protected $serialServices;

    public function __construct(SerialServices $serialServices)
    {
        $this->serialServices = $serialServices;
    }

    /**
     * Get one serial.
     */
    public function getOneSerial()
    {
        $this->serialServices->getOneSerial();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        $this->serialServices->deleteAll();

        return redirect()->route('serial.index')->with(['success_message' => 'Delete all successful']);
    }

    /**
     * Create Serial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.serial.create');
    }


    /**
     * Store Serial
     * @param SerialStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SerialStore $request)
    {
        $response = $this->serialServices->createSerials($request->all());

        return redirect()->route('serial.index')->with($response);
    }

    /**
     * List Serial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $serials = $this->serialServices->getSerials();

        return view('backend.serial.index', [
            'data' => $serials
        ]);
    }

    /**
     * Delete Serial
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->serialServices->deleteSerial($id);

        return redirect()->route('serial.index')->with(['success_message' => 'Delete successful']);
    }
}
