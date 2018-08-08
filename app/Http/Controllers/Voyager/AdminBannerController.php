<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Banner;
use App\Models\BannerImages;
use App\Models\BannerLinkPosition;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;


class AdminBannerController extends VoyagerBaseController
{
    //
    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        foreach ($dataType->editRows as $key => $row) {
            $details = json_decode($row->details);
            $dataType->editRows[$key]['col_width'] = isset($details->width) ? $details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);
        $get_banner = Banner::i()->getBanner($id);
        //print('<pre>'); print_r($get_category); exit;
        if (count($get_banner) > 0) {
            $banner = array();//
             /*   'status' => 1,
                'heigth' => 640,
                'width' => 480,
            );*/
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
            $banner_images = Banner::i()->getBannerImages($id);

            foreach ($banner_images as $banner_image) {
                if (is_file(get_file_path($banner_image['image']))) {
                    $image = $banner_image['image'];
                    $thumb = $banner_image['image'];
                } else {
                    $image = '';
                    $thumb = '';
                }

                $bannerimages[] = array(
                    'banner_image_description' => $banner_image['banner_image_description'],
                    'banner_link_position' => $banner_image['banner_link_position'],
                    'link' => $banner_image['link'],
                    'type' => $banner_image['type'],
                    'image' => $image,
                    'thumb' => Storage::url(get_image_cache($thumb, 100, 100)),
                    'sort_order' => $banner_image['order']
                );

            }
            $banner['banner_images'] = $bannerimages;
            $banner['banner_position'] = $banner_positions;
            $banner['banner_types'] = $banner_types;

        }

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','banner'));
    }

    public function storeBanner(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));


        $data = $request->all();

        $rules['name'] = 'required';
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $banner = Banner::firstOrNew(['banner.id' => $data['id']]);
            if (empty($banner)) {
                redirect()->back()->withInput();
            }
            //dd($data);
            $banner->status = isset($data['status']) ? (int)$data['status'] : 0;
            $banner->name = isset($data['name']) ? $data['name'] : '';
            $banner->height = isset($data['height']) ? $data['height'] : 640;
            $banner->width = isset($data['width']) ? $data['width'] : 480;
            //$banner->type = isset($data['type']) ? $data['type'] : '';

            if ($banner->save()) {

                $banner_id = $banner->id;

                //////////banner images

                BannerImages::where('banner_id', $banner_id)->delete();
                BannerLinkPosition::where('banner_id', $banner_id)->delete();
                if (isset($data['banner_image']) && (count($data['banner_image']) > 0) && ($data['banner_image'] != '')) {
                    $banrimg = array();

                    foreach ($data['banner_image'] as $key => $result) {

                        $img = '';
                        if (isset($result['image']) && is_file($result['image'])) {
                            $filename = $result['image']->getClientOriginalName();
                            $file = $result['image'];
                            $img = set_image_cache($file, 'banner');
                        } else {
                            $img = $result['image'];
                        }
                        $banrimg = array(
                            'banner_id' => $banner_id,
                            'description' => $result['banner_image_description'],
                            'image'       => $img,
                            'type'       => $result['type'],
                            'order' => $result['sort_order']
                        );

                        $banner_image_id = BannerImages::insertGetId($banrimg);


                        if (isset($result['banner_link_position']) && (count($result['banner_link_position']) > 0) && ($result['banner_link_position'] != '')) {
                            $banner_image_description_data = array();
                            foreach ($result['banner_link_position'] as $id => $banner_link){
                                if ($result['banner_link_position'][$id]['link'] != '') {
                                    $banner_image_description_data = array(
                                        'banner_id' => $banner_id,
                                        'banner_image_id' => $banner_image_id,
                                        'banner_position_id' => $id,
                                        'link' => $banner_link['link']
                                    );
                                    BannerLinkPosition::insert($banner_image_description_data);
                                }
                            }
                        }

                    }

                }

            }
            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }

    }

}
