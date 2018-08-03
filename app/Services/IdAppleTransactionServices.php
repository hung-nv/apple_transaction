<?php

namespace App\Services;


use App\Models\Apple;
use App\Models\IdApplePurchase;
use App\Models\IdAppleTransaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class IdAppleTransactionServices
{
    /**
     * Create apple transaction.
     * @param $username
     * @param $idApple
     * @param $money
     * @throws \Exception
     */
    public function createTransaction($username, $idApple, $money)
    {
        try {
            DB::beginTransaction();

            $this->savePackageTransaction($idApple, $money, $username);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }


    /**
     * Store transaction if successful.
     * @param string $idApple
     * @param string $money
     * @param string $username
     */
    public function savePackageTransaction($idApple, $money, $username)
    {
        $idPurchase = IdApplePurchase::getIdPurchaseByIdApple($idApple, $username);

        $user = User::getUserByUsername($username);

        if ($idPurchase && $user) {
            $idPurchase->transactions()->create([
                'money' => (int)$money,
                'user_id' => (int)$user->id
            ]);

            $totalMoney = $idPurchase->money_purchased + (int)$money;

            $idPurchase->update([
                'total_purchase_successful' => DB::raw('total_purchase_successful + 1'),
                'money_purchased' => DB::raw('money_purchased + ' . $money)
            ]);

            echo 'log thanh cong, tong so tien da nap: ' . number_format($totalMoney);
        } else {
            echo 'invalid';
        }
    }

    /**
     * Log transaction fail.
     * @param string $username
     * @param string $idApple
     */
    public function purchaseFail($username, $idApple)
    {
        $idPurchase = IdApplePurchase::getIdPurchaseByIdApple($idApple, $username);

        if ($idPurchase) {

            $solan = $idPurchase->total_puchase_fail + 1;

            $idPurchase->update([
                'total_puchase_fail' => DB::raw('total_puchase_fail + 1')
            ]);
            echo 'so lan fail: ' . $solan;
        } else {
            echo 'invalid';
        }
    }

    /**
     * Get all transactions.
     * @param $request
     * @return array
     */
    public function getTransactions($request)
    {
        $email = -1;
        if (isset($request->email) && $request->email != '-1') {
            $email = $request->email;
        }

        $pageSize = 10;
        if (isset($request->page_size) && is_numeric($request->page_size)) {
            $pageSize = $request->page_size;
        }

        $idTransactions = IdAppleTransaction::getAllTransactions($email, $pageSize);

        $return = ['email' => $email, 'pageSize' => $pageSize, 'idTransaction' => $idTransactions];

        return $return;
    }


    public function statistic($request)
    {
        $dataStatistic = IdAppleTransaction::getStatistic();
        return $dataStatistic;
    }
}