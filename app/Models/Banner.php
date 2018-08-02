<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'id';
    protected $fillable = ['*'];
    public $timestamps = false;
    public static $_instance = null;

    public static function i()
    {
        $class = get_called_class();
        if (!static::$_instance) {
            static::$_instance = new $class();
        }

        return static::$_instance;
    }
    public function bannerImages() {
        return $this->hasMany(BannerImages::class, 'banner_id');
    }


    public function bannerLinkPosition() {
        return $this->hasManyThrough(BannerLinkPosition::class, BannerImages::class, 'banner_image_id', 'banner_image_id','banner_id');
    }

}
