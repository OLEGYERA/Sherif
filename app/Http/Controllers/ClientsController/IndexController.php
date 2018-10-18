<?php

namespace App\Http\Controllers\ClientsController;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    

    //get exchange rate
    

    public function getIndex(){
        $banner = Banner::with(['bannerImages.bannerLinkPosition'])->first();
        return $this->viewMaker('Clients-page.index')->with([
            'banner' => $banner,
            'left_side_bar' => $this->left_sidebar("None")
        ]);
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

   
    public function getArticle(){
        return $this->viewMaker('article');
    }
    public function getOrdering(){
        return $this->viewMaker('ordering');
    }
    
    public function getStock(){
        return $this->viewMaker('stock');
    }
}
