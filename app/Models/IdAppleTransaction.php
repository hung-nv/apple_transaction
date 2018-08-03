<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IdAppleTransaction extends \Eloquent
{
    protected $table = 'id_apple_transactions';

    protected $fillable = [
        'money',
        'note',
        'user_id',
        'purchase_id'
    ];

    /**
     * Define relationship belong to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idPurchase()
    {
        return $this->belongsTo('App\Models\IdApplePurchase', 'purchase_id');
    }

    /**
     * use: me()
     * @param $query
     * @return mixed
     */
    public function scopeMe($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }

    /**
     * get all transactions.
     * @param string $email
     * @param int $pageSize
     * @return mixed
     */
    public static function getAllTransactions($email, $pageSize)
    {
        $idTransactions = self::orderByDesc('created_at')->me();

        if ($email != '-1') {

            $purchaseId = IdApplePurchase::getIdByEmail($email);

            if (empty($purchaseId)) {
                return null;
            }

            $idTransactions = $idTransactions->where('purchase_id', $purchaseId);
        }

        $idTransactions = $idTransactions->paginate($pageSize);

        return $idTransactions;
    }


    /**
     * Get statistic.
     * @param $type
     * @param $date
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getStatistic($type, $date)
    {
        if ($type === 'day') {
            $statistic = DB::table('id_apple_transactions')
                ->select(DB::raw('date(created_at) as time'), DB::raw('sum(money) as money'))
                ->groupBy(DB::raw('date(created_at)'))
                ->orderByDesc(DB::raw('date(created_at)'));

            if ($date && $date !== '-1') {
                $statistic = $statistic->where(DB::raw('date(created_at)'), $date);
            }
        }

        $statistic = $statistic->paginate(20);

        return $statistic;
    }
}
