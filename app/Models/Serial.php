<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serial extends \Eloquent
{
	protected $table = 'serials';

	protected $fillable = ['number', 'user_id', 'is_used'];
}
