<?php

namespace App\Services;


use App\Models\IphoneInformation;
use Illuminate\Support\Facades\DB;

class IphoneInformationServices
{

    /**
     * Create iphone Information
     *
     * @param array $data
     *
     * @throws \Exception
     */
    public function createIphoneInformation($data)
    {
        try {
            DB::beginTransaction();

            $this->storeIphoneInformations($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store Iphone Information Packages
     * @param array $data : http request
     */
    public function storeIphoneInformations($data)
    {
        // create iphone information
        $iphoneInformation = $this->saveIphoneInformation($data);

        if ($iphoneInformation) {
            if ($data['models']) {

                $models = explode(',', $data['models']);

                foreach ($models as $model) {
                    // create iphone information models
                    $iphoneInformation->iphoneInformationModels()->create([
                        'model' => trim($model)
                    ]);
                }
            }
        }
    }

    /**
     * Save Iphone Information
     * @param array $data : http request
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function saveIphoneInformation($data)
    {
        return IphoneInformation::create([
            'internal_name' => $data['internal_name'],
            'identify' => $data['identify']
        ]);
    }


    public function getIphoneInformations()
    {
        return IphoneInformation::orderByDesc('created_at')->paginate(20);
    }
}