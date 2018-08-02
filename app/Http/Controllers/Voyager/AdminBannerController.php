<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Banner;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class AdminBannerController extends VoyagerBaseController
{
    //
    public function edit(Request $request, $id)
    {

        $get_banner = Banner::with(['bannerImages','bannerLinkPosition'])->where('id',$id)->first();
        dd($get_banner->bannerImages->bannerLinkPosition);
        //print('<pre>'); print_r($get_category); exit;
        if (count($get_banner) > 0 ) {
            $banner = array();
            $banner = $get_banner[0];


            $banner_images = array();
            $bannerimages = array();

            $banner_positions = array(
                0 => 'pos1-1',
                1 => 'pos1-6',
                2 => 'pos2-6',
                3 => 'pos3-6',
                4 => 'pos4-6',
                5 => 'pos5-6',
                6 => 'pos6-6',
                7 => 'pos1-2',
                8 => 'pos2-2'
            );

            $banner_types = array(
                1 => '1-1',
                2 => '2-2',
                3 => '6-6',
            );
          /*  $banner_images = Banner::i()->getBannerImages($params);
            foreach ($banner_images as $banner_image){
                if (is_file(public_path($banner_image['image']))) {
                    $image = $banner_image['image'];
                    $thumb = $banner_image['image'];
                } else {
                    $image = '';
                    $thumb = '';
                }

                $bannerimages[] = array(
                    'banner_image_description' => $banner_image['banner_image_description'],
                    'banner_link_position'     => $banner_image['banner_link_position'],
                    'link'                     => $banner_image['link'],
                    'type'                     => $banner_image['type'],
                    'image'                    => $image,
                    'thumb'                    => get_image_url_cache($thumb, 100, 100,''),
                    'sort_order'               => $banner_image['sort_order']
                );*/
            }
    }

}
