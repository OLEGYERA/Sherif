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

Route::get('/', 'IndexController@getIndex')->name('index');
Route::get('/contacts', 'IndexController@getContacts')->name('contacts');
Route::get('/blog', 'IndexController@getBLog')->name('blog');
Route::get('/income', 'IndexController@getIncome')->name('income');
Route::get('/section', 'IndexController@getSection')->name('section');
Route::get('/article', 'IndexController@getArticle')->name('article');
Route::get('/ordering', 'IndexController@getOrdering')->name('ordering');
Route::get('/catalog', 'IndexController@getCatalog')->name('catalog');
Route::get('/stock', 'IndexController@getStock')->name('stock');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
