<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Auth\AuthController as DashboardAuthController;
use App\Http\Controllers\Dashboard\MainController as DashboardMainController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\ClientsController;
use App\Http\Controllers\Dashboard\CompaniesController;
use App\Http\Controllers\Dashboard\AddressessController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\BannersController;
use App\Http\Controllers\Dashboard\ShippingCompaniesController;
use App\Http\Controllers\Dashboard\CouponsController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\ClaimsController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\CitiesController;
use App\Http\Controllers\Dashboard\DistrictsController;
use App\Http\Controllers\Dashboard\NewslettersController;
use App\Http\Controllers\Dashboard\PaymentMethodsImagesController;
use App\Http\Controllers\Dashboard\EmailsController;

// Dashboard
Route::get('/app/login', [DashboardAuthController::class, 'loginPage'])->name('login'); // Done
Route::post('/app/login', [DashboardAuthController::class, 'loginAuth'])->name('loginAuth'); // Done
Route::post('/app/logout', [DashboardAuthController::class, 'logout'])->name('logout'); // Done
Route::get('/maintenance', [DashboardMainController::class, 'maintenance'])->name('maintenance'); // Done

Route::middleware(['web','admin', 'localization'])->prefix(LaravelLocalization::setLocale().'/app')->name('app.')->group(function () {
    Route::get('/', [DashboardMainController::class, 'index'])->name('dashboard'); // Done
    Route::get('logout', [DashboardAuthController::class, 'logout'])->name('logout'); // Done

    // Settings Area
    Route::get('settings/config', [SettingsController::class, 'config'])->name('settings.config'); // Done
    Route::get('settings/social', [SettingsController::class, 'social'])->name('settings.social'); // Done
    Route::get('settings/maintenance', [SettingsController::class, 'maintenance'])->name('settings.maintenance'); // Done
    Route::post('settings/update/{type}', [SettingsController::class, 'update'])->name('settings.update'); // Done
    Route::get('settings/remove_logo/{setting}', [SettingsController::class, 'remove_logo'])->name('settings.remove_logo'); // Done
    Route::get('settings/remove_footer_logo/{setting}', [SettingsController::class, 'remove_footer_logo'])->name('settings.remove_footer_logo'); // Done
    Route::get('settings/remove_icon/{setting}', [SettingsController::class, 'remove_icon'])->name('settings.remove_icon'); // Done

    // Roles Area
    Route::resource('roles', RolesController::class);

    // Admins Area
    Route::resource('admins', AdminsController::class);
    Route::get('admins/deleteForever/{admin}', [AdminsController::class, 'deleteForever'])->name('admins.deleteForever'); // Done
    Route::get('admins/restore/{admin}', [AdminsController::class, 'restore'])->name('admins.restore'); // Done
    Route::get('admins/is_active/{admin}', [AdminsController::class, 'is_active'])->name('admins.is_active'); // Done
    Route::get('admins/remove_image/{admin}', [AdminsController::class, 'remove_image'])->name('admins.remove_image'); // Done
    Route::post('admins/update_dark_position', [AdminsController::class, 'update_dark_position'])->name('admins.update_dark_position'); // Done

    // Clients Area
    Route::resource('clients', ClientsController::class);
    Route::get('clients/deleteForever/{client}', [ClientsController::class, 'deleteForever'])->name('clients.deleteForever'); // Done
    Route::get('clients/restore/{client}', [ClientsController::class, 'restore'])->name('clients.restore'); // Done
    Route::get('clients/is_active/{client}', [ClientsController::class, 'is_active'])->name('clients.is_active'); // Done
    Route::get('clients/remove_image/{client}', [ClientsController::class, 'remove_image'])->name('clients.remove_image'); // Done

    // Companies Area
    Route::resource('companies', CompaniesController::class);
    Route::get('companies/deleteForever/{company}', [CompaniesController::class, 'deleteForever'])->name('companies.deleteForever'); // Done
    Route::get('companies/restore/{company}', [CompaniesController::class, 'restore'])->name('companies.restore'); // Done
    Route::get('companies/is_active/{company}', [CompaniesController::class, 'is_active'])->name('companies.is_active'); // Done
    Route::get('companies/remove_image/{company}', [CompaniesController::class, 'remove_image'])->name('companies.remove_image'); // Done

    // Addressess Area
    Route::resource('addressess', AddressessController::class);

    // Categories Area
    Route::resource('categories', CategoriesController::class); // Done
    Route::get('categories/is_active/{category}', [CategoriesController::class, 'is_active'])->name('categories.is_active'); // Done
    Route::get('categories/remove_image/{category}', [CategoriesController::class, 'remove_image'])->name('categories.remove_image'); // Done

    // Brands Area
    Route::resource('brands', BrandsController::class); // Done
    Route::get('brands/is_active/{brand}', [BrandsController::class, 'is_active'])->name('brands.is_active'); // Done
    Route::get('brands/remove_image/{brand}', [BrandsController::class, 'remove_image'])->name('brands.remove_image'); // Done

    // Products Area
    Route::get('products/add_quantity', [ProductsController::class, 'add_quantity'])->name('products.add_quantity'); // Done
    Route::post('products/save_quantity', [ProductsController::class, 'save_quantity'])->name('products.save_quantity'); // Done
    Route::get('products/notifications', [ProductsController::class, 'notifications'])->name('products.notifications'); // Done
    Route::resource('products', ProductsController::class); // Done
    Route::get('products/is_active/{product}', [ProductsController::class, 'is_active'])->name('products.is_active'); // Done
    Route::get('products/remove_main_image/{product}', [ProductsController::class, 'remove_main_image'])->name('products.remove_main_image'); // Done
    Route::get('products/remove_images/{product}', [ProductsController::class, 'remove_images'])->name('products.remove_images'); // Done
    Route::get('products/remove_files/{product}', [ProductsController::class, 'remove_files'])->name('products.remove_files'); // Done

    // Banners Area
    Route::resource('banners', BannersController::class); // Done
    Route::get('banners/is_active/{banner}', [BannersController::class, 'is_active'])->name('banners.is_active'); // Done
    Route::get('banners/remove_image/{banner}', [BannersController::class, 'remove_image'])->name('banners.remove_image'); // Done

    // Coupons Area
    Route::resource('coupons', CouponsController::class); // Done
    Route::get('coupons/is_active/{coupon}', [CouponsController::class, 'is_active'])->name('coupons.is_active'); // Done

    // Orders Area
    Route::resource('orders', OrdersController::class); // Done
	Route::get('/orders_export', [OrdersController::class, 'orders_export'])->name('orders_export');
	// Route::get('/order_print/{order}', [OrdersController::class, 'order_print']);

    // Claims Area
    Route::resource('claims', ClaimsController::class);
    Route::get('claims_export', [ClaimsController::class, 'export'])->name('claims.export'); // Done

    // ContactUs Area
    Route::resource('contactus', ContactUsController::class);
    Route::get('contactus_export', [ContactUsController::class, 'export'])->name('contactus.export'); // Done

    // Cities Area
    Route::resource('cities', CitiesController::class);

    // Districts Area
    Route::resource('districts', DistrictsController::class);

    // Newsletters Area
    Route::resource('newsletters', NewslettersController::class); // Done
    Route::get('newsletters_export', [NewslettersController::class, 'export'])->name('newsletters.export'); // Done

    // Payment Methods Image
    Route::resource('payment_methods_images', PaymentMethodsImagesController::class); // Done
    Route::get('payment_methods_images/is_active/{payment_methods_image}', [PaymentMethodsImagesController::class, 'is_active'])->name('payment_methods_images.is_active'); // Done
    Route::get('payment_methods_images/remove_image/{payment_methods_image}', [PaymentMethodsImagesController::class, 'remove_image'])->name('payment_methods_images.remove_image'); // Done

    // Emails Area
    Route::get('emails', [EmailsController::class, 'index'])->name('emails.index'); // Done
    Route::get('emails/send', [EmailsController::class, 'send'])->name('emails.send'); // Done
    Route::post('emails/store', [EmailsController::class, 'store'])->name('emails.store'); // Done
    Route::delete('emails/destroy/{email}', [EmailsController::class, 'destroy'])->name('emails.destroy'); // Done

    Route::get('/403', function(){
        return view('403');
    })->name('403'); // Done
});
