<?php

namespace App\Http\Controllers\Voyager;

use App\Currency;
use App\Product;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class CurrenciesController extends VoyagerBaseController
{
    public function currencyUpdate() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = json_decode(curl_exec($ch));
        curl_close($ch);
        $USD = $output[0]->sale;
        $EUR = $output[1]->sale;

        Currency::where('name', 'USD')->update(['rate' => $USD]);
        Currency::where('name', 'EUR')->update(['rate' => $EUR]);

        $products = Product::get();

        foreach($products as $product) {
            $currency = Currency::where('id', '=', $product->currency_final)->first(); //retrieve currency object
            
            $price_final = ($product[$currency->name]) * ($product->profitability / 100) * $currency->rate;
            
            Product::where('id', '=', $product->id)->update(['price_final' => $price_final]);
        }

        return redirect()->route("voyager.currencies.index");
    }
}
