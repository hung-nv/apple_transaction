<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\IphoneInformationStore;
use App\Http\Requests\IphoneInformationUpdate;
use App\Http\Controllers\Controller;
use App\Services\IphoneInformationServices;

class IphoneInformationController extends Controller
{
    /**
     * Define name of services
     * @var IphoneInformationServices
     */
    protected $iphoneInformationServices;

    /**
     * IphoneInformationController constructor.
     * @param IphoneInformationServices $services
     */
    public function __construct(IphoneInformationServices $services)
    {
        parent::__construct();
        $this->iphoneInformationServices = $services;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->breadcrumbs = [
            ['label' => 'Iphone Information', 'url' => route('iphoneInformation.index')],
            ['label' => 'Insert']
        ];

        return view('backend.iphoneInformation.create');
    }

    /**
     * Save iphone Information.
     * @param IphoneInformationStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(IphoneInformationStore $request)
    {
        $this->iphoneInformationServices->createIphoneInformation($request->all());

        return redirect()->route('iphoneInformation.index')
            ->with(['success_message' => 'Create iPhone Information successful!']);
    }

    /**
     * List iphone informations.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $iphoneInformations = $this->iphoneInformationServices->getIphoneInformations();

        return view('backend.iphoneInformation.index', [
            'iphoneInformations' => $iphoneInformations
        ]);
    }

    /**
     * Edit iphone information.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit($id)
    {
        $iphoneInformation = $this->iphoneInformationServices->getIphoneInformationById($id);
        return view('backend.iphoneInformation.update', [
            'data' => $iphoneInformation
        ]);
    }

    /**
     * Update iphone Information.
     * @param IphoneInformationUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(IphoneInformationUpdate $request, $id)
    {
        $data = $request->all();
        $this->iphoneInformationServices->updateIphoneInformation($id, $data);
        return redirect()->route('iphoneInformation.index')->with(['success_message' => 'Update successful']);
    }

    /**
     * Delete iphone Information
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->iphoneInformationServices->deleteIphoneInformation($id);
        return redirect()->route('iphoneInformation.index')->with(['success_message' => 'Delete successful']);
    }
}
