<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImages extends Model
{
    protected $table = 'banner_image';
    protected $primaryKey = 'd';
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
    public function banner()
    {
        return $this->belongsTo(Banner::class,'id', 'banner_id');
    }
    public function bannerLinkPosition() {
        return $this->hasMany(BannerLinkPosition::class, 'banner_image_id', 'id');
    }
}
