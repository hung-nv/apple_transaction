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
     * use: ->me()
     * @param $query
     * @return mixed
     */
    public function scopeMe($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }

    /**
     * Get random id apple.
     * @param string $username
     * @return Model|null|object|static
     */
    public static function getRandomIdApple($username)
    {
        $user = User::getUserByUsername($username);

        if (empty($user)) {
            return null;
        }

        $idApple = Apple::inRandomOrder()->where('user_id', $user->id);

        return $idApple ? $idApple->first() : null;
    }

    /**
     * Get Id Apples with conditions.
     * @param $totalFail
     * @param $pageSize
     * @return mixed
     */
    public static function getIdApples($totalFail, $pageSize)
    {
        $idApples = self::orderByDesc('created_at')->me();

        if ($totalFail != '-1') {
            $idApples = $idApples->where('total_fail', $totalFail);
        }

        $idApples = $idApples->paginate($pageSize);

        return $idApples;
    }

    /**
     * Get id apple by email.
     * @param $email
     * @return Apple|Model|null|object
     */
    public static function getIdAppleByEmail($email)
    {
        $apple = self::where('email', $email);
        return $apple ? $apple->first() : null;
    }

    /**
     * @param string $username
     * @param string $email
     * @return null|mixed
     */
    public static function getIdAppleByEmailAndUsername($username, $email)
    {
        $user = User::getUserByUsername($username);

        if (empty($user)) {
            return null;
        }

        $idApple = self::withTrashed()->where('email', $email)->where('user_id', $user->id);

        return $idApple ? $idApple->first() : null;
    }
}
