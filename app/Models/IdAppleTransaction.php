<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdAppleTransaction extends Model
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
}
