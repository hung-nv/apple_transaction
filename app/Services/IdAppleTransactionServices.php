<?php

namespace App\Services;


use App\Models\Apple;
use App\Models\IdApplePurchase;
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
        $idPurchase = IdApplePurchase::getIdPurchaseByIdApple($idApple);

        $user = User::getUserByUsername($username);

        if ($idPurchase && $user) {
            $idPurchase->transactions()->create([
                'money' => (int)$money,
                'user_id' => (int)$user->id
            ]);

            $idPurchase->update([
                'total_purchase_successful' => DB::raw('total_purchase_successful + 1'),
                'money_purchased' => DB::raw('money_purchased + 1')
            ]);

            echo 'log thanh cong, tong so tien da nap: ' . number_format($idPurchase->money_purchased + int($money));
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
        $idPurchase = IdApplePurchase::getIdPurchaseByIdApple($idApple);

        $user = User::getUserByUsername($username);

        if ($idPurchase && $user) {
            $idPurchase->update([
                'total_puchase_fail' => DB::raw('total_puchase_fail + 1')
            ]);
            echo 'so lan fail: ' . ($idPurchase->total_puchase_fail + 1);
        } else {
            echo 'invalid';
        }
    }
}