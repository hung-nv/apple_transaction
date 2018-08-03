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

    /**
     * Log transaction done.
     * @param string $user
     * @param string $idApple
     * @param int $money
     * @throws \Exception
     */
    public function create($user, $idApple, $money)
    {
        $this->transactionServices->createTransaction($user, $idApple, $money);
    }

    /**
     * Log transaction fail.
     * @param string $user
     * @param string $idApple
     */
    public function createFail($user, $idApple)
    {
        $this->transactionServices->purchaseFail($user, $idApple);
    }


    /**
     * Get all transactions.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $dataTransaction = $this->transactionServices->getTransactions($request);
        return view('backend.idTransaction.index', [
            'transaction' => $dataTransaction['idTransaction'],
            'pageSize' => $dataTransaction['pageSize'],
            'email' => $dataTransaction['email']
        ]);
    }


    public function statistic(Request $request)
    {
        $statistic = $this->transactionServices->statistic($request);
        return view('backend.idTransaction.statistic', [
            'statistic' => $statistic
        ]);
    }
}
