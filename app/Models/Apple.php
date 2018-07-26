<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apple extends \Eloquent
{

    use SoftDeletes;

	/**
	 * @var string define table name.
	 */
    protected $table = 'apples';
	/**
	 * @var array list attribute can insert to table apples.
	 */
    protected $fillable = [
        'email',
        'password',
        'iphone_internal_name',
        'iphone_identify',
        'iphone_model',
        'total_fail',
        'user_id',
        'is_used'
    ];

    protected $dates = ['deleted_at'];

	/**
	 * Define relationship belongs to.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
