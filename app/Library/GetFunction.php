<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.07.2018
 * Time: 16:17
 */

namespace App\Library;

use Intervention\Image\Facades\Image;


class GetFunction
{
    public static function create_image_url_cache($filepath, $w,$h) {
        //print_r($filepath);
        $filepath = '/storage/' . $filepath;
        if (!is_file(platformSlashes(public_path($filepath)))) {
            dd(public_path($filepath));
            return ('/storage/placeholder.png');
        }

        $extension = pathinfo($filepath, PATHINFO_EXTENSION);

        $old_image = $filepath;
        $new_image = DIRECTORY_SEPARATOR.'cache' . mb_substr(platformSlashes($filepath), 0, mb_strrpos(platformSlashes($filepath), '.')) . '-' . $w . 'x' . $h . '.' . $extension;


        if (!is_file(platformSlashes(public_path($new_image)))) {
            $path = '';

            $directories = explode(DIRECTORY_SEPARATOR, dirname(str_replace('..'.DIRECTORY_SEPARATOR, '', $new_image)));

            foreach ($directories as $directory) {
                $path = $path . DIRECTORY_SEPARATOR . $directory;

                if (!is_dir(public_path(DIRECTORY_SEPARATOR.$path))) {
                    @mkdir(public_path(DIRECTORY_SEPARATOR.$path), 0777);

                }
            }
            //dd($directories);
            list($width_orig, $height_orig) = getimagesize(platformSlashes(public_path($old_image)));

            if ($width_orig != $w || $height_orig != $h) {
                Image::make(platformSlashes(public_path($old_image)))
                    ->resize($h, $w)
                    ->save(platformSlashes(public_path($new_image)));

                return $new_image;
            } else {
                copy(platformSlashes(public_path($old_image)), platformSlashes(public_path($new_image)));
                return $new_image;
            }
        } else {
            return $new_image;//('/uploads/placeholder.jpg');
        }
    }

}