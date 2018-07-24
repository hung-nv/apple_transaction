<?php

namespace App\Services;

use App\Models\Apple;
use App\Models\IphoneInformation;

class IdAppleServices
{
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
            if (count($arrayOfApple) > 1 and filter_var($arrayOfApple[0], FILTER_VALIDATE_EMAIL)) {
                // get random iphone Information
                $iphoneInformation = IphoneInformation::inRandomOrder()->first();
                // get random iphone information model
                $iphoneModelRandom = $iphoneInformation->iphoneInformationModels()->inRandomOrder()->first();

                // create id apple
                $idApple = $this->saveIdApple(
                    $arrayOfApple[0],
                    $arrayOfApple[1],
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
}