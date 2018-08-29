<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    public function wholesale()
    {
        return $this->hasMany('App\ProductWholesale');
    }

    public function edit_info()
    {
        return $this->hasOne('App\ProductEditInfo');
    }
}
