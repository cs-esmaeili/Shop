<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('user')->group(function () {

    Route::get('/firstPage', [
        'uses' => "UserController@firstPage",
        'as' => 'firstPage',

    ]);

    Route::post('/versionControl', [
        'uses' => "UserController@versionControl",
        'as' => 'versionControl',

    ]);
    Route::post('/mainCategory', [
        'uses' => "UserController@mainCategory",
        'as' => 'mainCategory',

    ]);
    Route::get('/product/{product_id}', [
        'uses' => "UserController@product",
        'as' => 'product',

    ]);

    Route::get('/product/images/{folder}', [
        'uses' => "UserController@productImages",
        'as' => 'productImages',

    ]);

    Route::get('/subCategory/{main_category_id}', [
        'uses' => "UserController@subCategory",
        'as' => 'subCategory',

    ]);

    Route::post('/productList', [
        'uses' => "UserController@productList",
        'as' => 'productList',

    ]);
    Route::post('/search', [
        'uses' => "UserController@search",
        'as' => 'search',
    ]);

    Route::post('/address', [
        'uses' => "UserController@address",
        'as' => 'address',
    ]);

    Route::post('/login', [
        'uses' => "UserAuthentication@login",
        'as' => 'login',
    ]);
    Route::post('/signup', [
        'uses' => "UserAuthentication@signup",
        'as' => 'signup',
    ]);

    Route::post('/signupCodeSender', [
        'uses' => "UserAuthentication@signupCodeSender",
        'as' => 'signupCodeSender',
    ]);

    Route::post('/signupVerify', [
        'uses' => "UserAuthentication@signupVerify",
        'as' => 'signupVerify',
    ]);
    Route::post('/resetPassword', [
        'uses' => "UserAuthentication@resetPassword",
        'as' => 'resetPassword',
    ]);
    Route::post('/resetPasswordCodeSender', [
        'uses' => "UserAuthentication@resetPasswordCodeSender",
        'as' => 'resetPasswordCodeSender',
    ]);
    Route::post('/resetPasswordVerify', [
        'uses' => "UserAuthentication@resetPasswordVerify",
        'as' => 'resetPasswordVerify',
    ]);

    Route::post('/resetPasswordAction', [
        'uses' => "UserAuthentication@resetPasswordAction",
        'as' => 'resetPasswordAction',
    ]);

    Route::post('/addressDelete', [
        'uses' => "UserController@addressDelete",
        'as' => 'addressDelete',
    ]);

    Route::post('/addressEdite', [
        'uses' => "UserController@addressEdite",
        'as' => 'addressEdite',
    ]);

    Route::post('/addressAdd', [
        'uses' => "UserController@addressAdd",
        'as' => 'addressAdd',
    ]);


    Route::post('/checkCart', [
        'uses' => "UserController@checkCart",
        'as' => 'checkCart',
    ]);

    Route::get('/getTime/{product_id}', [
        'uses' => "UserController@getTime",
        'as' => 'getTime',

    ]);
    Route::post('/factor', [
        'uses' => "UserController@factor",
        'as' => 'factor',
    ]);
    Route::post('/factorInformation', [
        'uses' => "UserController@factorInformation",
        'as' => 'factorInformation',
    ]);
    Route::post('/factorRating', [
        'uses' => "UserController@factorRating",
        'as' => 'factorRating',
    ]);

    Route::post('/Favorites', [
        'uses' => "UserController@Favorites",
        'as' => 'Favorites',

    ]);

    Route::post('/addFavorite', [
        'uses' => "UserController@addFavorite",
        'as' => 'addFavorite',

    ]);

    Route::post('/deleteFavorite', [
        'uses' => "UserController@deleteFavorite",
        'as' => 'deleteFavorite',

    ]);
    Route::post('/problems', [
        'uses' => "UserController@problems",
        'as' => 'problems',

    ]);


    Route::post('/view', [
        'uses' => "UserController@view",
        'as' => 'view',

    ]);

    Route::post('/product_favorite_check', [
        'uses' => "UserController@product_favorite_check",
        'as' => 'product_favorite_check',

    ]);
    Route::post('/peyment_step', [
        'uses' => "UserController@peyment_step",
        'as' => 'peyment_step',

    ]);
    Route::post('/add_cart', [
        'uses' => "UserController@add_cart",
        'as' => 'add_cart',

    ]);
    Route::post('/cart_products', [
        'uses' => "UserController@cart_products",
        'as' => 'cart_products',

    ]);

    Route::post('/save_card', [
        'uses' => "UserController@save_card",
        'as' => 'save_card',

    ]);

    Route::post('/open_gate', [
        'uses' => "UserController@open_gate",
        'as' => 'open_gate',
    ]);

    Route::get('/close_gate/{token}/', [
        'uses' => "UserController@close_gate",
        'as' => 'close_gate',
    ]);

    Route::prefix('payment')->group(function () {
        Route::post('/start', [
            'uses' => "PaymentController@start",
            'as' => 'paymentStart',
        ]);

        Route::get('/end/{token}/', [
            'uses' => "PaymentController@end",
            'as' => 'paymentEnd',
        ]);

    });

});

Route::prefix('admin')->group(function () {
    Route::post('/login', [
        'uses' => "AdminController@login",
        'as' => 'admin_login',

    ]);

    Route::post('/createAdmin', [
        'uses' => "AdminController@createAdmin",
        'as' => 'createAdmin',

    ]);
    Route::post('/ordercomestart', [
        'uses' => "AdminController@ordercomestart",
        'as' => 'ordercomestart',

    ]);

    Route::post('/Getorder', [
        'uses' => "AdminController@Getorder",
        'as' => 'Getorder',

    ]);
    Route::post('/Getorder_back', [
        'uses' => "AdminController@Getorder_back",
        'as' => 'Getorder_back',

    ]);

    Route::post('/get_products_back', [
        'uses' => "AdminController@get_products_back",
        'as' => 'get_products_back',

    ]);

    Route::post('/getproducts', [
        'uses' => "AdminController@getproducts",
        'as' => 'getproducts',

    ]);

    Route::post('/Listanbarha', [
        'uses' => "AdminController@Listanbarha",
        'as' => 'Listanbarha',

    ]);

    Route::post('/rezef', [
        'uses' => "AdminController@rezef",
        'as' => 'rezef',

    ]);


    Route::post('/returnrezerf', [
        'uses' => "AdminController@returnrezerf",
        'as' => 'returnrezerf',

    ]);

    Route::post('/GetCouriers', [
        'uses' => "AdminController@GetCouriers",
        'as' => 'GetCouriers',
    ]);

    Route::post('/Send_To_warehouse', [
        'uses' => "AdminController@Send_To_warehouse",
        'as' => 'Send_To_warehouse',
    ]);

    Route::post('/pdf', [
        'uses' => "AdminController@pdf",
        'as' => 'pdf',

    ]);

    Route::post('/all_subcategory', [
        'uses' => "AdminController@all_subcategory",
        'as' => 'all_subcategory',

    ]);

    Route::post('/Getorderdetails', [
        'uses' => "AdminController@Getorderdetails",
        'as' => 'Getorderdetails',
    ]);
    Route::post('/returnallrezerf', [
        'uses' => "AdminController@returnallrezerf",
        'as' => 'returnallrezerf',
    ]);

    Route::post('/searchkala', [
        'uses' => "AdminController@searchkala",
        'as' => 'searchkala',
    ]);

    Route::post('/savekaladata', [
        'uses' => "AdminController@savekaladata",
        'as' => 'savekaladata',
    ]);

    Route::any('/images/{folder}', [
        'uses' => "UserController@productImages",
        'as' => 'productImages',

    ]);

    Route::post('/deleteintoimage', [
        'uses' => "AdminController@deleteintoimage",
        'as' => 'deleteintoimage',
    ]);

    Route::post('/setspeacial', [
        'uses' => "AdminController@setspeacial",
        'as' => 'setspeacial',
    ]);

    Route::post('/uploadintoimage', [
        'uses' => "AdminController@uploadintoimage",
        'as' => 'uploadintoimage',
    ]);


    Route::post('/addkala', [
        'uses' => "AdminController@addkala",
        'as' => 'addkala',
    ]);


    Route::post('/wearehouseCapacity', [
        'uses' => "AdminController@wearehouseCapacity",
        'as' => 'wearehouseCapacity',
    ]);

    Route::post('/thumbnail', [
        'uses' => "AdminController@thumbnail",
        'as' => 'thumbnail',
    ]);
    Route::post('/delete_factor_product', [
        'uses' => "AdminController@delete_factor_product",
        'as' => 'delete_factor_product',
    ]);

    Route::post('/add_factor_product', [
        'uses' => "AdminController@add_factor_product",
        'as' => 'add_factor_product',
    ]);

    Route::post('/factor_product_reject', [
        'uses' => "AdminController@factor_product_reject",
        'as' => 'factor_product_reject',
    ]);

    Route::post('/factor_product_change_warehouse', [
        'uses' => "AdminController@factor_product_change_warehouse",
        'as' => 'factor_product_change_warehouse',
    ]);

    Route::post('/way', [
        'uses' => "AdminController@way",
        'as' => 'way',
    ]);

    Route::post('/send_to_courier', [
        'uses' => "AdminController@send_to_courier",
        'as' => 'send_to_courier',
    ]);

});

Route::prefix('courier')->group(function () {
    Route::post('/createCourier', [
        'uses' => "CourierController@createCourier",
        'as' => 'createCourier',
    ]);
    Route::post('/CheckEnter', [
        'uses' => "CourierController@CheckEnter",
        'as' => 'CheckEnter',
    ]);
    Route::post('/getfactors', [
        'uses' => "CourierController@getfactors",
        'as' => 'getfactors',
    ]);

    Route::post('/tahvil', [
        'uses' => "CourierController@tahvil",
        'as' => 'tahvil',
    ]);
});

Route::prefix('warehouse')->group(function () {
    Route::post('/createWarehouse', [
        'uses' => "WarehouseController@createWarehouse",
        'as' => 'createWarehouse',
    ]);
    Route::post('/CheckEnter', [
        'uses' => "WarehouseController@CheckEnter",
        'as' => 'CheckEnter',
    ]);

    Route::post('/Getorder', [
        'uses' => "WarehouseController@Getorder",
        'as' => 'Getorder',
    ]);

    Route::post('/send_admin', [
        'uses' => "WarehouseController@send_admin",
        'as' => 'send_admin',
    ]);

    Route::post('/tahvil', [
        'uses' => "WarehouseController@tahvil",
        'as' => 'tahvil',
    ]);
});
Route::prefix('superadmin')->group(function () {
    Route::post('/clearimages', [
        'uses' => "SuperAdminController@clearimages",
        'as' => 'clearimages',
    ]);

    Route::get('/addfake', [
        'uses' => "SuperAdminController@addfake",
        'as' => 'addfake',
    ]);

    Route::get('/somefolder', [
        'uses' => "SuperAdminController@somefolder",
        'as' => 'somefolder',
    ]);

    Route::get('/fakefoldername', [
        'uses' => "SuperAdminController@fakefoldername",
        'as' => 'fakefoldername',
    ]);

    Route::get('/fiximages', [
        'uses' => "SuperAdminController@fiximages",
        'as' => 'fiximages',
    ]);

    Route::get('/replace', [
        'uses' => "SuperAdminController@replace",
        'as' => 'replace',
    ]);

    Route::post('/setspical', [
        'uses' => "SuperAdminController@setspical",
        'as' => 'setspical',
    ]);

});
