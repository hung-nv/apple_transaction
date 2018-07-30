<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'rate', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    /**
     * Get user by username.
     * @param $username
     * @return User|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function getUserByUsername($username)
    {
        $user = self::where('username', $username);
        return $user ? $user->first() : null;
    }
}
