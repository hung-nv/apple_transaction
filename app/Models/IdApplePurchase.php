<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * use: me()
     * @param $query
     * @return mixed
     */
    public function scopeMe($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }

    /**
     * Get all id purchases.
     * @return mixed
     */
    public static function getIdPurchases()
    {
        return self::orderByDesc('created_at')->me()->paginate(20);
    }
}
