<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditCard extends \Eloquent
{
    use SoftDeletes;

    protected $table = 'credit_cards';

	protected $fillable = ['number', 'user_id', 'total_success', 'total_fail'];

    /**
     * Define relationship belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function user() {
		return $this->belongsTo('App\Models\User');
	}

    /**
     * use: ->me()
     * @param $query
     * @return mixed
     */
	public function scopeMe($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }

    /**
     * Get a random credit card by username.
     * @param $username
     * @return CreditCard|Model|null|object
     */
    public static function getCreditCardByUsername($username)
    {
        $user = User::getUserByUsername($username);

        if($user) {
            $creditCard = self::where('user_id', $user->id)->inRandomOrder();
            return $creditCard ? $creditCard->first() : null;
        }

        return null;
    }

    /**
     * Get credit card by username and number.
     * @param $username
     * @param $number
     * @return CreditCard|Model|null|object
     */
    public static function getCreditCardByUserAndNumber($username, $number)
    {
        $user = User::getUserByUsername($username);

        if($user) {
            $creditCard = self::where('user_id', $user->id)->where('number', $number)->first();
            return $creditCard;
        }

        return null;
    }
}
