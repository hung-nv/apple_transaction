<?php

namespace App\Services;

use App\Models\Serial;

class SerialServices
{
    /**
     * Get one serial.
     */
    public function getOneSerial()
    {
        $serial = Serial::inRandomOrder()->first();
        if ($serial) {
            echo $serial->number;
            $serial->delete();
        } else {
            echo 'het';
        }
    }

    /**
     * Get all Serials.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSerials()
    {
        return Serial::paginate(20);
    }

    /**
     * Create Serials.
     * @param array $data
     * @return array
     */
    public function createSerials($data)
    {
        // format data
        $serials = explode("\n", trim($data['serials']));
        $serials = array_filter($serials, 'trim'); // remove any extra \r characters left behind

        $countSerial = 0;
        foreach ($serials as $line) {
            // create credit card
            $serial = Serial::firstOrCreate([
                'number' => trim($line),
                'user_id' => \Auth::user()->id
            ]);

            // increment number of record create successful
            if ($serial) {
                $countSerial++;
            }
        }

        $response = ['success_message' => 'Total Serials insert successful: ' . $countSerial];

        return $response;
    }

    /**
     * Delete credit card.
     * @param int $id
     * @throws \Exception
     */
    public function deleteSerial($id)
    {
        try {
            Serial::findOrFail($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Delete all Serials.
     */
    public function deleteAll()
    {
        Serial::truncate();
    }
}