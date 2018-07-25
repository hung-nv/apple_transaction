<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends \Eloquent
{
    protected $table = 'credit_cards';

	protected $fillable = ['number', 'user_id', 'is_used'];

	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}
