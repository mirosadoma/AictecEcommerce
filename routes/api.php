<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Namespaces
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\MainController;

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
        Route::get('all_categories',[MainController::Class,'all_categories']); // done
        Route::get('all_banners',[MainController::Class,'all_banners']); // done
        Route::get('latest_products',[MainController::Class,'latest_products']); // done
        Route::get('best_selling_products',[MainController::Class,'best_selling_products']); // done
        Route::get('show_product/{product}',[MainController::Class,'show_product']); // done
    });

    Route::group(['middleware' => 'auth:api'], function() {
        Route::group(['prefix'=>'profile'], function () {
            Route::get('/view', [ProfileController::Class,'view_profile']);
            Route::post('/save', [ProfileController::Class,'save_profile']);
            Route::post('/new_password', [ProfileController::Class,'new_password']);
        });
    });


    // Route::controller(TwitterController::class)->group(function(){
    //     Route::get('auth/twitter', 'redirectToTwitter')->name('auth.twitter');
    //     Route::get('auth/twitter/callback', 'handleTwitterCallback');
    // });
});
