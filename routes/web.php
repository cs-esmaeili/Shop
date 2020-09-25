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

Route::get('/successful/{ref}', function (Illuminate\Http\Request $request) {
    return view('api.successful', ['ref' => $request->ref]);
});

Route::any('/unsuccessful', function () {
    return view('api.unsuccessful');
});

Route::get('/successful_weight/{ref}', function (Illuminate\Http\Request $request) {
    return view('api.successful_weight', ['ref' => $request->ref]);
});

Route::any('/unsuccessful_weight', function () {
    return view('api.unsuccessful_weight');
});

Route::get('/', [
    'uses' => "WebController@firstpage",
    'as' => 'web_firstpage',
]);
Route::get('/product', [
    'uses' => "WebController@product",
    'as' => 'web_product',
]);

//Route::get('/index', [
//    'uses' => "IndexController@donwloadlink",
//    'as' => 'donwloadlink',
//]);

Route::any('/search', [
    'uses' => "WebController@search",
    'as' => 'web_search',
]);

Route::get('/category', [
    'uses' => "WebController@category",
    'as' => 'web_category',
]);
Route::get('/subcategory/{main_category_id}', [
    'uses' => "WebController@subcategory",
    'as' => 'web_subcategory',
]);
Route::get('/subcategory_product/{product_category}/{page_number}', [
    'uses' => "WebController@subcategory_product",
    'as' => 'web_subcategory_product',
]);
Route::get('/about_us', [
    'uses' => "WebController@about_us",
    'as' => 'web_about_us',
]);
Route::get('/rules', [
    'uses' => "WebController@rules",
    'as' => 'web_rules',
]);
Route::any('/login', [
    'uses' => "WebController@login",
    'as' => 'web_login',
]);

Route::any('/sign_up', [
    'uses' => "WebController@sign_up",
    'as' => 'web_sign_up',
]);

Route::get('/enter_code', [
    'uses' => "WebController@enter_code",
    'as' => 'web_enter_code',
]);

Route::any('/reset_password', [
    'uses' => "WebController@reset_password",
    'as' => 'web_reset_password',
]);

Route::get('/favorites', [
    'uses' => "WebController@Favorites",
    'as' => 'web_Favorites',
]);
Route::any('/deleteFavorites/{product_id}', [
    'uses' => "WebController@deleteFavorites",
    'as' => 'web_deleteFavorites',
]);
Route::get('/addFavorites/{product_id}', [
    'uses' => "WebController@addFavorites",
    'as' => 'web_addFavorites',
]);
Route::get('/address', [
    'uses' => "WebController@web_address",
    'as' => 'web_address',
]);
Route::get('/address_delete/{user_address_id}', [
    'uses' => "WebController@address_delete",
    'as' => 'web_address_delete',
]);
Route::any('/address_edit', [
    'uses' => "WebController@address_edit",
    'as' => 'web_address_edit',
]);
Route::get('/add_card/{product_id}', [
    'uses' => "WebController@add_card",
    'as' => 'web_add_card',
]);

Route::get('/delete_card/{product_id}', [
    'uses' => "WebController@delete_card",
    'as' => 'web_delete_card',
]);

Route::get('/card', [
    'uses' => "WebController@card",
    'as' => 'web_card',
]);

Route::get('/payment_step1', [
    'uses' => "WebController@payment_step1",
    'as' => 'web_payment_step1',
]);
Route::post('/payment', [
    'uses' => "WebController@payment",
    'as' => 'web_payment',
]);
Route::get('/orders', [
    'uses' => "WebController@orders",
    'as' => 'web_orders',
]);
Route::get('/order_information/{factor_id}', [
    'uses' => "WebController@order_information",
    'as' => 'web_order_information',
]);
Route::get('/card_plus/{product_id}', [
    'uses' => "WebController@card_plus",
    'as' => 'web_card_plus',
]);
Route::get('/card_mines/{product_id}', [
    'uses' => "WebController@card_mines",
    'as' => 'web_card_mines',
]);
