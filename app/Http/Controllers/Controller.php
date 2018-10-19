<?php

namespace App\Http\Controllers;

/*For Left Sidebar*/
use App\Category;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //variable to show admin's part
    public $is_admin = true;

    //exchange rate
    public $uah_to_usd = 0;
    public $uah_to_eur = 0;

    public function __construct(){
        if($this->is_admin){
            // $this->getExchange();
        }
    }


    public function getExchange(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = json_decode(curl_exec($ch));
        curl_close($ch);
        $this->uah_to_usd = $output[0]->sale;
        $this->uah_to_eur = $output[1]->sale;
    }

    //view maker
    public function viewMaker($page){
        if($this->is_admin){
            $params = [
                'is_admin'=>$this->is_admin,
                'uah_to_eur'=>$this->uah_to_eur,
                'uah_to_usd'=>$this->uah_to_usd
            ];
        }else{
            $params = [
                'is_admin'=>$this->is_admin
            ];
        }
        return view($page,$params);
    }



    /*Left Sidebar*/

    protected function left_sidebar($status){
    	$category = Category::all();
        $Global_category = [];
        $Sub_category = [];
        foreach ($category as $value) {
            if($value->parent_id == NULL){
                array_push($Global_category, $value);
            }else{
                array_push($Sub_category, $value);
            }
        }
        return $left_side_bar = view('layouts.left_side_bar')->with([
            'Global_category' => $Global_category,
            'Sub_category' => $Sub_category,
            'status' => $status
        ])->render();
    }



}
