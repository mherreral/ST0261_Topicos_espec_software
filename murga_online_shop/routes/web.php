<?php

//Authors: Manuela Herrera López, Samuel Palacios, Ana Arango

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

//Route::get('/', 'App\Http\Controllers\User\HomeController@index')->name("user.home.index");
Route::get('/', 'App\Http\Controllers\User\LiquorController@index')->name("user.home.index");

//liquors
Route::get('/liquors', 'App\Http\Controllers\User\LiquorController@index')->name("user.liquor.index");
Route::get('/liquors/{id}', 'App\Http\Controllers\User\LiquorController@show')->name("user.liquor.show");

// Auth needed

//Admin
Route::middleware('admin')->group(
    function () {

        Route::get(
            '/admin',
            'App\Http\Controllers\Admin\HomeController@index'
        )->name('admin.home.index');

        Route::get(
            '/admin/customer',
            'App\Http\Controllers\Admin\CustomerController@index'
        )->name("admin.customer.index");

        Route::get(
            '/admin/customer/setadmin',
            'App\Http\Controllers\Admin\CustomerController@setAdmin'
        )->name("admin.customer.setAdmin");

        Route::get(
            '/admin/customer/delete',
            'App\Http\Controllers\Admin\CustomerController@delete'
        )->name("admin.customer.delete");

        Route::post(
            '/admin/customer/save',
            'App\Http\Controllers\Admin\CustomerController@save'
        )->name("admin.customer.save");

        Route::get(
            '/admin/customer/{id}',
            'App\Http\Controllers\Admin\CustomerController@show'
        )->name("admin.customer.show");

        Route::get(
            '/admin/liquor/create',
            'App\Http\Controllers\Admin\LiquorController@create'
        )->name("admin.liquor.create");

        Route::post(
            '/admin/liquor/save',
            'App\Http\Controllers\Admin\LiquorController@save'
        )->name("admin.liquor.save");

        Route::get(
            '/admin/liquors',
            'App\Http\Controllers\Admin\LiquorController@index'
        )->name("admin.liquor.index");

        Route::get(
            '/admin/liquors/{id}',
            'App\Http\Controllers\Admin\LiquorController@show'
        )->name("admin.liquor.show");

        Route::post(
            '/admin/liquors/delete/{id}',
            'App\Http\Controllers\Admin\LiquorController@delete'
        )->name("admin.liquor.delete");

        Route::get(
            '/admin/liquors/edit/{id}',
            'App\Http\Controllers\Admin\LiquorController@edit'
        )->name("admin.liquor.edit");

        Route::post(
            '/admin/liquors/edit/{id}',
            'App\Http\Controllers\Admin\LiquorController@update'
        )->name("admin.liquor.update");
    }
);

//User

Route::middleware('auth')->group(
    function () {
        //Wishlists
        Route::get('/wishlists', 'App\Http\Controllers\User\WishlistController@index')->name("user.wishlist.index");
        Route::get('/wishlists/create', 'App\Http\Controllers\User\WishlistController@create')->name("user.wishlist.create");
        Route::post('/wishlists/save', 'App\Http\Controllers\User\WishlistController@save')->name("user.wishlist.save");
        Route::get('/wishlists/{id}', 'App\Http\Controllers\User\WishlistController@show')->name("user.wishlist.show");
        Route::delete('/wishlists/delete/{id}', 'App\Http\Controllers\User\WishlistController@delete')->name("user.wishlist.delete");
        Route::post('/wishlist/add/{id}', 'App\Http\Controllers\User\WishlistController@addItem')->name('user.wishlist.add');

        //Liquors
        // Route::get('/liquors/{id}', 'App\Http\Controllers\User\LiquorController@show')->name("user.liquor.show");
        Route::post('/search', 'App\Http\Controllers\User\LiquorController@search')->name("user.liquor.search");

        //Cart
        Route::post('/cart/add/{id}', 'App\Http\Controllers\User\ShoppingCartController@add')->name("user.shoppingCart.add");
        Route::get('/cart', 'App\Http\Controllers\User\ShoppingCartController@index')->name("user.shoppingCart.index");
        Route::get('/cart/purchase', 'App\Http\Controllers\User\ShoppingCartController@purchase')->name('user.shoppingCart.purchase');
        Route::get('/cart/delete', 'App\Http\Controllers\User\ShoppingCartController@delete')->name('user.shoppingCart.delete');

        //Comments
        Route::get('/comment/create/{id}', 'App\Http\Controllers\User\CommentController@createComment')->name("user.comment.create");
        Route::post('/comment/save/{id}', 'App\Http\Controllers\User\CommentController@saveComment')->name("user.comment.save");
    }
);

Route::get('lang/{locale}', 'App\Http\Controllers\LanguageController@switch')->name('language.switch');

//TeamApi
Route::get('/beers', 'App\Http\Controllers\User\TeamApi@index')->name("user.teamApi.index");
