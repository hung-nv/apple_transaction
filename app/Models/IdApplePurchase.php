<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class IdApplePurchase extends \Eloquent
{
    use SoftDeletes;

    /**
     * @var string define table name.
     */
    protected $table = 'id_apple_purchases';

    /**
     * @var array list attribute can insert to table.
     */
    protected $fillable = [
        'id_device',
        'imei',
        'language',
        'apple_id',
        'serial_id',
        'total_purchase_successful',
        'total_puchase_fail',
        'money_purchased',
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Define relationship belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Define relationship belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apple()
    {
        return $this->belongsTo('App\Models\Apple', 'apple_id');
    }

    /**
     * Define relationship belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serial()
    {
        return $this->belongsTo('App\Models\Serial');
    }

    /**
     * Define relationship has many.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\IdAppleTransaction', 'purchase_id');
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
     * With condition in last 3 day.
     * @param $query
     * @return mixed
     */
    public function scopeTimeDelay($query)
    {
        return $query->havingRaw('(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(created_at)) < ?', [259200]);
    }

    /**
     * Get all id purchases.
     * @param int $totalFail
     * @param int $pageSize
     * @return mixed
     */
    public static function getIdPurchases($totalFail, $pageSize)
    {
        $idPurchases = self::orderByDesc('created_at')->me();

        if ($totalFail != '-1') {
            $idPurchases = $idPurchases->where('total_puchase_fail', $totalFail);
        }

        $idPurchases = $idPurchases->paginate($pageSize);

        return $idPurchases;
    }

    /**
     * Get Id purchase. (can chon random trong 1 khoang thoi gian, neu khong se bi lap lai)
     * @param int $userId
     * @param string $device
     * @return IdApplePurchase|Model|null|object
     */
    public static function getOneIdPurchase($userId, $device)
    {
        return self::where('user_id', $userId)
            ->where('id_device', $device)
            ->inRandomOrder()
            ->timeDelay()
            ->first();
    }

    /**
     * Get id purchase by id apple.
     * @param $idApple
     * @param null $username
     * @return IdApplePurchase|Model|null|object
     */
    public static function getIdPurchaseByIdApple($idApple, $username = null)
    {
        $apple = Apple::getIdAppleByEmail($idApple);

        if ($apple) {
            $idPurchase = self::where('apple_id', $apple->id);

            if ($username) {
                $user = User::getUserByUsername($username);

                $idPurchase = $idPurchase->where('user_id', $user->id);
            }

            return $idPurchase ? $idPurchase->first() : null;
        }

        return null;
    }

    /**
     * Get purchase id by email
     * @param string $email
     * @return mixed
     */
    public static function getIdByEmail($email)
    {
        $model = DB::table('id_apple_purchases as a')
            ->select('a.id as purchaseId')
            ->join('apples as b', 'b.id', '=', 'a.apple_id')
            ->where('b.email', 'like', '%'.$email.'%')
            ->first();

        return $model ? $model->purchaseId : null;
    }
}
