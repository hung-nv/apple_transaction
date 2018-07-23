<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IphoneInformation extends \Eloquent
{
    /**
     * @var string define table name
     */
    protected $table = 'iphone_informations';

    /**
     * @var array attribute can insert
     */
    protected $fillable = ['internal_name', 'identify'];

    /**
     * Define relationship has many
     */
    public function iphoneInformationModels()
    {
        return $this->hasMany('App\Models\IphoneInformationModel', 'iphone_information_id');
    }
}
