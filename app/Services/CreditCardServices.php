<?php

namespace App\Services;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreditCardServices
{
    /**
     * Get one credit card.
     */
    public function getOneCredit($username)
    {
        $creditCard = CreditCard::getCreditCardByUsername($username);

        if ($creditCard) {
            echo $creditCard->number;
        } else {
            echo 'het';
        }
    }

    public function deleteHandle($username, $number)
    {
        $creditCard = CreditCard::getCreditCardByUserAndNumber($username, $number);

        if ($creditCard) {
            $creditCard->delete();
            echo 'xoa thanh cong';
        } else {
            echo 'fail';
        }
    }

    /**
     * Log if add credit card successful.
     * @param $username
     * @param $number
     */
    public function addCreditDone($username, $number)
    {
        $creditCard = CreditCard::getCreditCardByUserAndNumber($username, $number);

        if ($creditCard) {
            $solan = $creditCard->total_success + 1;
            
            $creditCard->update([
                'total_success' => DB::raw('total_success + 1')
            ]);

            echo 'so lan add thanh cong: ' . $solan;
        } else {
            echo 'sai thong tin';
        }
    }

    /**
     * Log if add credit card fail.
     * @param string $user
     * @param string $number
     */
    public function addCreditFail($username, $number)
    {
        $creditCard = CreditCard::getCreditCardByUserAndNumber($username, $number);

        if ($creditCard) {
            $solan = $creditCard->total_fail + 1;

            $creditCard->update([
                'total_fail' => DB::raw('total_fail + 1')
            ]);

            echo 'so lan add fail: ' . $solan;
        } else {
            echo 'sai thong tin';
        }
    }

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

    /**
     * Add credit card by api.
     * @param $username
     * @param $number
     */
    public function addCreditHandler($username, $number)
    {
        $user = User::getUserByUsername($username);

        if (empty($user)) {
            echo 'user khong dung';
        }

        $creditCard = CreditCard::create([
            'user_id' => $user->id,
            'number' => $number
        ]);

        if ($creditCard) {
            echo 'thanh cong';
        } else {
            echo 'fail';
        }
    }
}