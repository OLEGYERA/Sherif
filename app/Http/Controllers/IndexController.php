<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //variable to show admin's part
    public $is_admin = false;

    //exchange rate
    public $uah_to_usd = 0;
    public $uah_to_eur = 0;

    public function __construct(){
        if($this->is_admin){
            $this->getExchange();
        }
    }

    //get exchange rate
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

    public function getIndex(){
        return $this->viewMaker('index');
    }

    public function getContacts(){
        return $this->viewMaker('contacts');
    }

    public function getBLog(){
        return $this->viewMaker('blog');
    }

    public function getIncome(){
        return $this->viewMaker('income');
    }

    public function getSection(){
        return $this->viewMaker('section');
    }
    public function getArticle(){
        return $this->viewMaker('article');
    }
    public function getOrdering(){
        return $this->viewMaker('ordering');
    }
    public function getCatalog(){
        return $this->viewMaker('catalog');
    }
    public function getStock(){
        return $this->viewMaker('stock');
    }
}
