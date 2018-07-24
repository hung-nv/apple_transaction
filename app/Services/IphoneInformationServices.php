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
            // create iphone information model
            $this->saveIphoneInformationModels($iphoneInformation, $data['models']);
        }
    }

    /**
     * Save Iphone Information.
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

    /**
     * Get all iphone Information.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getIphoneInformations()
    {
        return IphoneInformation::orderByDesc('created_at')->paginate(20);
    }

    /**
     * Get Iphone Information By Id.
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function getIphoneInformationById($id)
    {
        try {
            $iphoneInformation = IphoneInformation::findOrFail($id);
        } catch (\Exception $exception) {
            throw $exception;
        }
        return $iphoneInformation;
    }

    /**
     * Update Iphone Information.
     * @param int $id
     * @param array $data
     * @throws \Exception
     */
    public function updateIphoneInformation($id, $data)
    {
        try {
            $this->saveIphoneInformationById($id, $data);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Save iphone Information By Id
     * @param int $id
     * @param array $data
     * @throws \Exception
     */
    public function saveIphoneInformationById($id, $data)
    {
        $iphoneInformation = $this->updateIphoneInformationById($id, $data['internal_name'], $data['identify']);

        if ($iphoneInformation) {
            $iphoneInformation->iphoneInformationModels()->delete();
            $this->saveIphoneInformationModels($iphoneInformation, $data['models']);
        }
    }

    /**
     * Update Iphone Information.
     * @param $id
     * @param $internal_name
     * @param $identify
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function updateIphoneInformationById($id, $internal_name, $identify)
    {
        $iphoneInformation = $this->getIphoneInformationById($id);

        if ($iphoneInformation) {
            $iphoneInformation->internal_name = $internal_name;
            $iphoneInformation->identify = $identify;
            $iphoneInformation->save();
        }

        return $iphoneInformation;
    }

    /**
     * Save iphone Information Models
     * @param $iphoneInformation
     * @param $models
     */
    private function saveIphoneInformationModels($iphoneInformation, $models)
    {
        if ($models) {
            $models = explode(',', $models);

            $multiModels = [];
            foreach ($models as $model) {
                $multiModels[] = ['iphone_model' => trim($model)];
            }

            // create iphone information models
            $iphoneInformation->iphoneInformationModels()->createMany($multiModels);
        }
    }

    /**
     * Delete iphone Information.
     * @param $id
     * @throws \Exception
     */
    public function deleteIphoneInformation($id)
    {
        try {
            $this->destroyIphoneInformation($id);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Destroy iphone Information and models.
     * @param $id
     * @throws \Exception
     */
    public function destroyIphoneInformation($id)
    {
        $iphoneInformation = $this->getIphoneInformationById($id);

        if ($iphoneInformation) {
            $iphoneInformation->iphoneInformationModels()->delete();
            $iphoneInformation->delete();
        }
    }

    /**
     * Check iphone information has data
     * @return array
     */
    public function checkIphoneInformation()
    {
        $iphoneInformation = IphoneInformation::inRandomOrder()->first();

        if ($iphoneInformation) {
            $iphoneModelRandom = $iphoneInformation->iphoneInformationModels()->inRandomOrder()->first();
        }

        if(empty($iphoneModelRandom)) {
            $responseJson = [
                'url' => route('iphoneInformation.create'),
                'message' => 'You need create iPhone Information first.'
            ];
        } else {
            $responseJson = [
                'url' => route('apple.create'),
                'message' => 'ok'
            ];
        }

        return $responseJson;
    }
}
