<?php
use App\Library\GetFunction;

/**
* Get image url
*
* @param img relative path
* @return img url
*/
if (!function_exists('get_image_cache')) {
    function get_image_cache($img_path, $w, $h)
    {
        return GetFunction::create_image_url_cache($img_path, $w, $h);
    }
}

if (!function_exists('platformSlashes')) {
    function platformSlashes($path)
    {
        return str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, str_replace('/', DIRECTORY_SEPARATOR, $path));
    }
}

if (!function_exists('generate_filename')) {
    /* Generate Unique filename */
    function generate_filename($dir, $ext)
    {
        do {
            $name = str_random(10).'.'.$ext;
        } while (file_exists($dir.$name));

        return $name;
    }
}