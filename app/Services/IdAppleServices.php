<?php

namespace App\Services;

use App\Models\Apple;
use App\Models\IphoneInformation;
use Illuminate\Support\Facades\DB;

class IdAppleServices
{
    /**
     * Force deleting id apple.
     * @param $idApple
     * @throws \Exception
     */
    public function forceDestroy($idApple)
    {
        // get id apple
        $apple = Apple::where('email', $idApple)->first();

        // if exist
        if ($apple) {
            try {
                $apple->delete();
                echo 'da xoa';
            } catch (\Exception $exception) {
                echo 'idapple nay da co du lieu ngam hoac da co giao dich mua nen khong xoa duoc';
            }
        } else {
            echo 'invalid';
        }
    }

    /**
     * Log if add information fail.
     * @param string $idApple
     */
    public function addInformationFail($idApple)
    {
        // get id apple
        $apple = Apple::withTrashed()->where('email', $idApple)->first();

        // get current add fail.
        $number = $apple->total_fail;

        // check if it's trashed
        if ($apple->trashed()) {
            $apple->restore();
            $apple->update(['total_fail' => DB::raw('total_fail + 1')]);

            echo ($number + 1) . ' lan';
        } else {
            echo 'invalid';
        }
    }

    /**
     * Get one id apple.
     */
    public function getOneIdApple()
    {
        $idApple = Apple::inRandomOrder()->first();
        if ($idApple) {
            $idApple->delete();
            echo $idApple->email . '|' . $idApple->password . '|' . $idApple->iphone_internal_name . '|'
                . $idApple->iphone_identify . '|' . $idApple->iphone_model;
        } else {
            echo 'het';
        }
    }

    /**
     * Get all id apples and params.
     * @param $request
     * @return array
     */
    public function getIdApples($request)
    {
        $fail = -1;
        if (isset($request->fail) && $request->fail != '-1' && is_numeric($request->fail)) {
            $fail = $request->fail;
        }

        $pageSize = 10;
        if (isset($request->page_size) && is_numeric($request->page_size)) {
            $pageSize = $request->page_size;
        }

        $idApples = Apple::getIdApples($fail, $pageSize);

        $return = ['fail' => $fail, 'pageSize' => $pageSize, 'idApples' => $idApples];

        return $return;
    }

    /**
     * * Create multi id apples
     * @param array $data
     * @return array
     */
    public function createIdApple($data)
    {
        // format data
        $idApples = explode("\n", trim($data['apple_ids']));
        $idApples = array_filter($idApples, 'trim'); // remove any extra \r characters left behind

        $countIdApple = 0;
        foreach ($idApples as $line) {
            $arrayOfApple = explode('|', trim($line));

            if (count($arrayOfApple) > 1 && filter_var(trim($arrayOfApple[0]), FILTER_VALIDATE_EMAIL)) {
                // get random iphone Information
                $iphoneInformation = IphoneInformation::inRandomOrder()->first();
                // get random iphone information model
                $iphoneModelRandom = $iphoneInformation->iphoneInformationModels()->inRandomOrder()->first();

                // create id apple
                $idApple = $this->saveIdApple(
                    trim($arrayOfApple[0]),
                    trim($arrayOfApple[1]),
                    $iphoneInformation->internal_name,
                    $iphoneInformation->identify,
                    $iphoneModelRandom->iphone_model,
                    \Auth::user()->id
                );

                // increment number of record create successful
                if ($idApple) {
                    $countIdApple++;
                }
            }
        }

        $response = ['success_message' => 'Total id Apple insert successful: ' . $countIdApple];

        return $response;
    }

    /**
     * Store Id Apple
     * @param string $email
     * @param string $password
     * @param string $internalName
     * @param string $identify
     * @param string $model
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveIdApple($email, $password, $internalName, $identify, $model, $userId)
    {
        return Apple::firstOrCreate([
            'email' => $email,
            'password' => $password,
            'iphone_internal_name' => $internalName,
            'iphone_identify' => $identify,
            'iphone_model' => $model,
            'user_id' => $userId
        ]);
    }

    /**
     * Delete Id Apple
     * @param int $id
     * @throws \Exception
     */
    public function deleteIdApple($id)
    {
        try {
            Apple::findOrFail($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Delete multi selected id apples.
     * @param array $data
     * @throws \Exception
     */
    public function deleteSelectedIdApple($data)
    {
        try {
            Apple::destroy($data['idApples']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}