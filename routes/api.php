<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Namespaces
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AddressessController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\OrdersController;

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

Route::group(['middleware'=>'api'], function () {

    // Auth
    Route::group(['prefix'=>'auth'], function () {
        Route::post('register',[AuthController::Class,'register']); // done
        Route::post('login',[AuthController::Class,'login']); // done
        Route::post('forget',[AuthController::Class,'forget']); // done
        Route::post('resend_code',[AuthController::Class,'resend_code']); // done
        Route::post('check_code',[AuthController::Class,'check_code']); // done
        Route::post('reset_password',[AuthController::Class,'reset_password']); // done
        Route::post('logout',[AuthController::Class,'logout']); // done
        //socials
        Route::group(['middleware' => 'web'], function() {
            Route::any('authorized/google',[AuthController::Class,'redirectToGoogle']); // done
            Route::any('authorized/google/callback',[AuthController::Class,'handleGoogleCallback']); // done

            Route::get('twitter', [AuthController::Class,'redirectToTwitter']);
            Route::get('twitter/callback', [AuthController::Class,'handleTwitterCallback']);
        });
    });
    // Main
    Route::group(['prefix'=>'main'], function () {
        Route::any('site_settings',[MainController::Class,'site_settings']); // done
        Route::any('search',[MainController::Class,'search']); // done
        Route::any('products_filter',[MainController::Class,'products_filter']); // done
        Route::get('all_categories',[MainController::Class,'all_categories']); // done
        Route::get('all_brands',[MainController::Class,'all_brands']); // done
        Route::get('all_payment_methods_images',[MainController::Class,'all_payment_methods_images']); // done
        Route::get('all_banners',[MainController::Class,'all_banners']); // done
        Route::get('all_resons',[MainController::Class,'all_resons']); // done
        Route::get('latest_products',[MainController::Class,'latest_products']); // done
        Route::get('best_selling_products',[MainController::Class,'best_selling_products']); // done
        Route::get('show_product/{product}',[MainController::Class,'show_product']); // done
        Route::post('/add_newsletter', [MainController::class, 'add_newsletter']); // Done
        Route::post('/send_contact', [MainController::class, 'send_contact']); // Done
    });

    Route::group(['middleware' => 'auth:api'], function() {
        // profile
        Route::group(['prefix'=>'profile'], function () {
            // My Profile
            Route::get('/view', [ProfileController::Class,'view_profile']); // Done
            Route::post('/save', [ProfileController::Class,'save_profile']); // Done
            Route::post('/new_password', [ProfileController::Class,'new_password']); // Done
            // Addressess
            Route::get('/view_address', [AddressessController::Class,'view_address']); // Done
            Route::post('/add_address', [AddressessController::Class,'add_address']); // Done
            Route::post('/update_address/{address}', [AddressessController::Class,'update_address']); // Done
            Route::post('/delete_address/{address}', [AddressessController::Class,'delete_address']); // Done
            // Favorites
            Route::get('/my_favorites', [FavoritesController::Class,'my_favorites']); // Done
            Route::post('/update_favorites/{address}', [FavoritesController::Class,'update_favorites']); // Done
        });
        // orders
        Route::group(['prefix'=>'main'], function () {
            Route::post('/send_claim', [MainController::class, 'send_claim']); // Done
        });
        // orders
        Route::group(['prefix'=>'orders'], function () {
            Route::post('/check_coupon', [OrdersController::Class,'check_coupon']);//////////////////////
            Route::post('/check_out', [OrdersController::Class,'check_out']);//////////////////////

        });
    });


    // Route::controller(TwitterController::class)->group(function(){
    //     Route::get('auth/twitter', 'redirectToTwitter')->name('auth.twitter');
    //     Route::get('auth/twitter/callback', 'handleTwitterCallback');
    // });
});
