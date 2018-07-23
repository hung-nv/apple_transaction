<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\IphoneInformationStore;
use App\Http\Controllers\Controller;
use App\Services\IphoneInformationServices;

class IphoneInformationController extends Controller
{
    protected $iphoneInformationServices;

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

    public function store(IphoneInformationStore $request)
    {
        $this->iphoneInformationServices->createIphoneInformation($request->all());

        return redirect()->route('iphoneInformation.index')
            ->with(['messages' => 'Create iPhone Information successful!']);
    }

    public function index()
    {
        $iphoneInformations = $this->iphoneInformationServices->getIphoneInformations();

        return view('backend.iphoneInformation.index', [
            'iphoneInformations' => $iphoneInformations
        ]);
    }
}
