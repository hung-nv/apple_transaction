<?php

namespace App\Services;


use App\Models\Apple;
use App\Models\IdApplePurchase;
use App\Models\Serial;
use App\Models\User;

class IdPurchaseServices
{
    /**
     * @param string $user: username
     * @param string $device
     * @param string $idApple
     * @param string $number
     * @param string $imei
     * @param string $lang
     * @return string
     */
    public function createIdPurchase($user, $device, $idApple, $number, $imei, $lang)
    {
        // check invaid params.
        if (empty($user) || empty($device) || empty($idApple) || empty($number) || empty($imei) || empty($lang)) {
            $message = 'invalid';
            return $message;
        }

        $user = User::where('username', $user)->first();

        if (empty($user)) {
            $message = 'user khong dung';
        } else {
            // get id apple.
            $apple = Apple::where('email', $idApple)->first();
            // get serial.
            $serial = Serial::where('number', $number)->first();

            if (empty($apple) || empty($serial)) {
                $message = 'thong tin sai';
            } else {
                IdApplePurchase::firstOrCreate([
                    'id_device' => $device,
                    'imei' => $imei,
                    'language' => $lang,
                    'apple_id' => $apple->id,
                    'serial_id' => $serial->id,
                    'user_id' => $user->id
                ]);
                $message = 'thanh cong';
            }
        }

        return $message;
    }

    /**
     * Get all id purchase.
     * @return mixed
     */
    public function getIdPurchases()
    {
        return IdApplePurchase::getIdPurchases();
    }
}