<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IphoneInformationModel extends Model
{
    protected $table = 'iphone_information_models';

    protected $fillable = ['model'];

    public function iphoneInformation()
    {
        return $this->belongsTo('App\Models\IphoneInformation');
    }
}
