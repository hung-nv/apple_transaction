<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apple extends \Eloquent
{
	/**
	 * @var string define table name.
	 */
    protected $table = 'apples';
	/**
	 * @var array list attribute can insert to table apples.
	 */
    protected $fillable = ['email', 'password', 'iphone_internal_name', 'iphone_identify', 'iphone_model', 'user_id'];

	/**
	 * Define relationship belongs to.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
