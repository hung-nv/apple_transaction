<?php

namespace App\Http\Controllers\Backend;

use App\Services\IdAppleTransactionServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdAppleTransactionController extends Controller
{
    protected $transactionServices;

    public function __construct(IdAppleTransactionServices $idAppleTransactionServices)
    {
        parent::__construct();
        $this->transactionServices = $idAppleTransactionServices;
    }

    public function create($user, $idApple, $money)
    {
        $this->transactionServices->createTransaction($user, $idApple, $money);
    }

    public function createFail($user, $idApple)
    {
        $this->transactionServices->purchaseFail($user, $idApple);
    }
}
