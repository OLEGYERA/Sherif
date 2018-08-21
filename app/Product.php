<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    public function wholesale()
    {
        return $this->hasMany('App\ProductWholesale');
    }
}
