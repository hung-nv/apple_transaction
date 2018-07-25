<?php

namespace App\Services;

use App\Models\CreditCard;

class CreditCardServices
{
    /**
     * Get all credit cards.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCreditCards()
    {
        return CreditCard::paginate(20);
    }

    /**
     * Create credit cards.
     * @param array $data
     * @return array
     */
    public function createCreditCards($data)
    {
        // format data
        $creditCards = explode("\n", trim($data['credit_cards']));
        $creditCards = array_filter($creditCards, 'trim'); // remove any extra \r characters left behind

        $countCreditCard = 0;
        foreach ($creditCards as $line) {
            // create credit card
            $creditCard = CreditCard::firstOrCreate([
                'number' => trim($line),
                'user_id' => \Auth::user()->id
            ]);

            // increment number of record create successful
            if ($creditCard) {
                $countCreditCard++;
            }
        }

        $response = ['success_message' => 'Total Credit Cards insert successful: ' . $countCreditCard];

        return $response;
    }

    /**
     * Delete credit card.
     * @param int $id
     * @throws \Exception
     */
    public function deleteCreditCard($id)
    {
        try {
            CreditCard::findOrFail($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Delete all credit cards.
     */
    public function deleteAll()
    {
        CreditCard::truncate();
    }
}