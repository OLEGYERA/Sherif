<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ClientsController\IndexController@getIndex')->name('index');

/*Catalog Routes*/
Route::get('catalog/{slug}', 'ClientsController\CatalogController@getCatalog')->name('catalog');
Route::get('catalog/{slug}/{subslug}', 'ClientsController\CatalogController@getSubCatalog')->name('subCatalog');


/*Product Routes*/
Route::get('catalog/{slug}/{subslug}/{product}', 'ClientsController\ProductController@getProduct')->name('product');




/*Basket Routes*/


Route::get('/contacts', 'IndexController@getContacts')->name('contacts');
Route::get('/blog', 'IndexController@getBLog')->name('blog');
Route::get('/income', 'ClientsController\IndexController@getIncome')->name('income');
// Route::get('/section', 'ClientsController\IndexController@getSection')->name('section');
Route::get('/article', 'ClientsController\IndexController@getArticle')->name('article');
Route::get('/ordering', 'ClientsController\IndexController@getOrdering')->name('ordering');

Route::get('/stock', 'ClientsController\IndexController@getStock')->name('stock');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();


    // Update currency rate
    Route::get('/currency_update', 'Voyager\CurrenciesController@currencyUpdate');

    //expand categories as tree
    Route::post('treeajax', 'Voyager\CategoriesController@showsecond');

    //expand articles categories as tree
    Route::post('treeajax_articles', 'Voyager\ArticlesCategoriesController@showsecond');

    ////////////abanners
    Route::put('banner/{id}/save', [
        'uses' => 'Voyager\AdminBannerController@storeBanner',
        'as'   => 'admin.banner.save'
    ]);
    Route::post('banner/save', [
        'uses' => 'Voyager\AdminBannerController@storeBanner',
        'as'   => 'admin.banner.store'
    ]);
  /*  Route::post('attribute_values/save', [
        'uses' => 'Voyager\AttributeValuesController@store',
        'as'   => 'voyager.attribute-values.store'
    ]);*/

  Route::post('/get_attributes_id','Voyager\AttributeController@getAttribValues');



/*Product Characteristics*/
   Route::get('/product-characteristics', 'Voyager\CharacteristicsController@showList')->name('voyager.product-characteristics.index');

   /*AJAX*/
   Route::get('/get/categories', 'Voyager\CharacteristicsController@getCategories');
   Route::post('/add/characteristic', 'Voyager\CharacteristicsController@addCharacteristic');
   Route::put('/edit/characteristic/{id}', 'Voyager\CharacteristicsController@editCharacteristic');
   Route::delete('/delete/characteristic/{id}', 'Voyager\CharacteristicsController@deleteCharacteristic');
   Route::get('/get/characteristic/{id}', 'Voyager\CharacteristicsController@getcharacteristic');


   /*In product*/

   Route::get('/get/characteristic', 'Voyager\CharacteristicsController@getSelectCharacteristic');
/*END Product Characteristics*/


   
});

Auth::routes();
Route::get('/account', 'Account\AccountController@index')->name('account');

Route::post('/account/savepersonal','Account\AccountController@store')->name('saveUserPersonal');
Route::post('/account/saveuserpassword','Account\AccountController@storePassword')->name('saveUserPassword');




