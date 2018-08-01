<?php

namespace App\Services;


use App\Models\Apple;
use App\Models\IdApplePurchase;
use App\Models\Serial;
use App\Models\User;

class IdPurchaseServices
{
    /**
     * @param string $user : username
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
            $message = 'invalid';
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
     * @param $request
     * @return array
     */
    public function getIdPurchases($request)
    {
        $fail = -1;
        if (isset($request->fail) && $request->fail != '-1' && is_numeric($request->fail)) {
            $fail = $request->fail;
        }

        $pageSize = 10;
        if (isset($request->page_size) && is_numeric($request->page_size)) {
            $pageSize = $request->page_size;
        }

        $idPurchases = IdApplePurchase::getIdPurchases($fail, $pageSize);

        $return = ['fail' => $fail, 'pageSize' => $pageSize, 'idApples' => $idPurchases];

        return $return;
    }

    /**
     * Get one id purchase to use.
     * @param $username
     * @param $device
     * @throws \Exception
     */
    public function getOneIdPurchase($username, $device)
    {
        $user = User::where('username', $username)->first();

        if (empty($user)) {
            echo 'invalid';
        } else {
            $idpurchase = IdApplePurchase::getOneIdPurchase($user->id, $device);
            if ($idpurchase) {
                $idpurchase->delete();
                echo $idpurchase->apple->email . '|' . $idpurchase->apple->password;
            } else {
                echo 'khong co';
            }
        }
    }

    /**
     * Delete by handle api.
     * @param $user
     * @param $idApple
     * @throws \Exception
     */
    public function deleteHandle($user, $idApple)
    {
        $idPurchase = IdApplePurchase::getIdPurchaseByIdApple($idApple, $user);

        if ($idPurchase) {
            $idPurchase->delete();
            echo 'da xoa';
        } else {
            echo 'invalid';
        }
    }

    /**
     * Delete all selected id purchases.
     * @param $data
     * @throws \Exception
     */
    public function deleteSelectedIdPurchase($data)
    {
        try {
            Apple::destroy($data['idPurchases']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}