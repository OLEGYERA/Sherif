<?php

namespace App\Http\Controllers\ClientsController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategoriesPivot as CategoryPivot;
use Illuminate\Support\Facades\Cache;
use App\Category;
use App\Product;

class CatalogController extends Controller
{	
	/**/
   	public function getCatalog($slug){
   		$CurrentCategory = Category::where('slug', $slug)->first();
   		$SubCategory = [];
   		foreach (Category::all() as $key => $value) {
   			if($value->parent_id == $CurrentCategory->id){
   				array_push($SubCategory, $value);
   			}
   		}
        return $this->viewMaker('Clients-page.catalog')->with([
            'left_side_bar' => $this->left_sidebar($slug),
            'data' => $SubCategory,
            'CurrentCategory' => $CurrentCategory
        ]);
    }


    public function getSubCatalog($slug, $subslug){
   		$CurrentCategory = Category::where('slug', $slug)->first();
   		$CurrentSubCategory = Category::where('slug', $subslug)->first();
   		$Products = [];

      // Cache::put('name', $CurrentSubCategory, 1);
      // dd(Cache::get('name'));
   		foreach (CategoryPivot::all() as $value) {
   			if($value->category_id == $CurrentSubCategory->id){
   				$product = Product::find($value->product_id);
   				array_push($Products, $product);
   			}
   		}
        return $this->viewMaker('Clients-page.subcatalog')->with([
            'left_side_bar' => $this->left_sidebar($slug),
            'data' => $Products,
            'CurrentCategory' => $CurrentCategory,
            'CurrentSubCategory' => $CurrentSubCategory,
        ]);
    }
}
