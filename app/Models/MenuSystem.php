<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSystem extends \Eloquent
{
    protected $table = 'menu_system';

    public $timestamps = false;

    public function childrens() {
        return $this->hasMany('App\Models\MenuSystem', 'parent_id');
    }
}
