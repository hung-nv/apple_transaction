<?php

namespace App\Http\Controllers\Backend;

use App\Services\IdPurchaseServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdApplePurchaseController extends Controller
{
    protected $idPurchaseServices;

    public function __construct(IdPurchaseServices $idPurchaseServices)
    {
        $this->idPurchaseServices = $idPurchaseServices;
    }

    /**
     * Create Id Purchase.
     * @param string $user
     * @param string $device
     * @param string $idApple
     * @param string $number
     * @param string $imei
     * @param string $lang
     */
    public function create($user, $device, $idApple, $number, $imei, $lang)
    {
        $response = $this->idPurchaseServices->createIdPurchase($user, $device, $idApple, $number, $imei, $lang);
        echo $response;
    }


    public function index()
    {
        $idPurchases = $this->idPurchaseServices->getIdPurchases();

        return view('backend.idPurchase.index', [
            'idPurchases' => $idPurchases,
            'pageSize' => 10
        ]);
    }

    /**
     * Get a id purchase to use.
     * @param string $user
     * @param string $device
     * @throws \Exception
     */
    public function getOneIdPurchase($user, $device)
    {
        $this->idPurchaseServices->getOneIdPurchase($user, $device);
    }

    /**
     * Delete id purchase by handle api.
     * @param string $user
     * @param string $idApple
     * @throws \Exception
     */
    public function deleteHandle($user, $idApple)
    {
        $this->idPurchaseServices->deleteHandle($user, $idApple);
    }
}
