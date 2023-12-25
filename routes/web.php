<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);
Route::get('/privacy-policy', [App\Http\Controllers\FrontController::class, 'privacy']);
Route::get('/terms-and-conditions', [App\Http\Controllers\FrontController::class, 'terms']);
Route::get('/about-us', [App\Http\Controllers\FrontController::class, 'about']);
Route::get('/contact-us', [App\Http\Controllers\FrontController::class, 'contact']);
Route::post('/contact-us', [App\Http\Controllers\FrontController::class, 'contact'])->name('contact');
Route::get('/agreements', [App\Http\Controllers\FrontController::class, 'products']);
Route::get('/agreement/{slug}', [App\Http\Controllers\FrontController::class, 'productDetails']);
Route::get('/blogs', [App\Http\Controllers\FrontController::class, 'blogs']);
Route::get('/blog/{slug}', [App\Http\Controllers\FrontController::class, 'blog']);

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('clientCarts');
Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('clientAddToCart');
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('clientUpdateCart');
Route::post('/delete-cart', [App\Http\Controllers\CartController::class, 'deleteCart'])->name('clientDeleteCart');

Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('clientWishlist');
Route::post('/add-to-wishlist', [App\Http\Controllers\WishlistController::class, 'addToWishlist'])->name('clientAddToWishlist');
Route::post('/update-wishlist', [App\Http\Controllers\WishlistController::class, 'updateWishlist'])->name('clientUpdateWishlist');
Route::post('/delete-wishlist', [App\Http\Controllers\WishlistController::class, 'deleteWishlist'])->name('clientDeleteWishlist');


Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index']);
Route::post('/process-checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('process.checkout');
Route::get('/checkout/cancel', [App\Http\Controllers\CheckoutController::class, 'cancel']);
Route::get('/checkout/success', [App\Http\Controllers\CheckoutController::class, 'success']);

Route::get('/auth/admin', [App\Http\Controllers\Auth\AdminController::class, 'index']);
Route::post('/auth/admin', [App\Http\Controllers\Auth\AdminController::class, 'index'])->name('admin.auth');

Route::post('/yoco/webhook', [App\Http\Controllers\YocoWebhookController::class, 'handle']);
Route::get('/yoco/register/webhook', [App\Http\Controllers\YocoWebhookController::class, 'register']);

Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'googleHandleProvider']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'googleHandleProviderCallback']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/agreements', [App\Http\Controllers\UserController::class, 'agreements']);
Route::get('/user/generate-agreement/{id}', [App\Http\Controllers\UserController::class, 'generate_agreement']);
Route::post('/user/generate-agreement/{id}', [App\Http\Controllers\UserController::class, 'generate_agreement'])->name('generate.agreement');
Route::get('/user/agreement/view/{id}', [App\Http\Controllers\UserController::class, 'agreement_view']);
Route::post('/user/download-agreement/{id}', [App\Http\Controllers\UserController::class, 'download_agreement'])->name('download.agreement');
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile']);
Route::post('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/sales-by-month', [App\Http\Controllers\Admin\DashboardController::class, 'sales_by_month']);
    
    Route::get('/categories', [App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('admin.category');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoriesController::class, 'create']);
    Route::post('/categories/store', [App\Http\Controllers\Admin\CategoriesController::class, 'store'])->name('admin.category.store');
    Route::post('/categories/update/{id}', [App\Http\Controllers\Admin\CategoriesController::class, 'update'])->name('admin.category.update');
    Route::get('/categories/edit/{id}', [App\Http\Controllers\Admin\CategoriesController::class, 'edit']);
    Route::delete('/categories/delete/{id}', [App\Http\Controllers\Admin\CategoriesController::class, 'delete'])->name('admin.category.delete');
    
    Route::get('/promotions', [App\Http\Controllers\Admin\PromotionsController::class, 'index'])->name('admin.promotion');
    Route::get('/promotions/create', [App\Http\Controllers\Admin\PromotionsController::class, 'create']);
    Route::post('/promotions/store', [App\Http\Controllers\Admin\PromotionsController::class, 'store'])->name('admin.promotion.store');
    Route::post('/promotions/update/{id}', [App\Http\Controllers\Admin\PromotionsController::class, 'update'])->name('admin.promotion.update');
    Route::get('/promotions/edit/{id}', [App\Http\Controllers\Admin\PromotionsController::class, 'edit']);
    Route::delete('/promotions/delete/{id}', [App\Http\Controllers\Admin\PromotionsController::class, 'delete'])->name('admin.promotion.delete');
    
    Route::get('/testimonials', [App\Http\Controllers\Admin\TestimonialsController::class, 'index'])->name('admin.testimonial');
    Route::get('/testimonials/create', [App\Http\Controllers\Admin\TestimonialsController::class, 'create']);
    Route::post('/testimonials/store', [App\Http\Controllers\Admin\TestimonialsController::class, 'store'])->name('admin.testimonial.store');
    Route::post('/testimonials/update/{id}', [App\Http\Controllers\Admin\TestimonialsController::class, 'update'])->name('admin.testimonial.update');
    Route::get('/testimonials/edit/{id}', [App\Http\Controllers\Admin\TestimonialsController::class, 'edit']);
    Route::delete('/testimonials/delete/{id}', [App\Http\Controllers\Admin\TestimonialsController::class, 'delete'])->name('admin.testimonial.delete');
    
    Route::get('/agreements', [App\Http\Controllers\Admin\AgreementsController::class, 'index'])->name('admin.agreements');
    Route::get('/agreements/create', [App\Http\Controllers\Admin\AgreementsController::class, 'create']);
    Route::post('/agreements/store', [App\Http\Controllers\Admin\AgreementsController::class, 'store'])->name('admin.agreement.store');
    Route::post('/agreements/update/{id}', [App\Http\Controllers\Admin\AgreementsController::class, 'update'])->name('admin.agreement.update');
    Route::get('/agreements/edit/{id}', [App\Http\Controllers\Admin\AgreementsController::class, 'edit']);
    Route::delete('/agreements/delete/{id}', [App\Http\Controllers\Admin\AgreementsController::class, 'delete'])->name('admin.agreement.delete');
    
    Route::get('/agreements/inputs/{id}', [App\Http\Controllers\Admin\AgreementsController::class, 'add_inputs']);
    Route::get('/agreements/get-input/{id}', [App\Http\Controllers\Admin\AgreementsController::class, 'agreement_append_input']);
    Route::post('/agreements/save-inputs/{id}', [App\Http\Controllers\Admin\AgreementsController::class, 'save_inputs']);
    Route::post('/agreements/import-doc', [App\Http\Controllers\Admin\AgreementsController::class, 'import_doc']);
    
    Route::get('/customfields', [App\Http\Controllers\Admin\CustomFieldsController::class, 'index'])->name('admin.customfields');
    Route::get('/customfields/create', [App\Http\Controllers\Admin\CustomFieldsController::class, 'create']);
    Route::get('/customfields/create-ajax', [App\Http\Controllers\Admin\CustomFieldsController::class, 'create_ajax']);
    Route::post('/customfields/store', [App\Http\Controllers\Admin\CustomFieldsController::class, 'store'])->name('admin.customfield.store');
    Route::post('/customfields/update/{id}', [App\Http\Controllers\Admin\CustomFieldsController::class, 'update'])->name('admin.customfield.update');
    Route::get('/customfields/edit/{id}', [App\Http\Controllers\Admin\CustomFieldsController::class, 'edit']);
    Route::get('/customfields/edit-ajax/{id}', [App\Http\Controllers\Admin\CustomFieldsController::class, 'edit_ajax']);
    Route::delete('/customfields/delete/{id}', [App\Http\Controllers\Admin\CustomFieldsController::class, 'delete'])->name('admin.customfield.delete');
    Route::get('/customfields/delete-ajax/{id}', [App\Http\Controllers\Admin\CustomFieldsController::class, 'delete_ajax']);
    
    
    Route::get('/blog-categories', [App\Http\Controllers\Admin\BlogCategoriesController::class, 'index'])->name('admin.blogcategory');
    Route::get('/blog-categories/create', [App\Http\Controllers\Admin\BlogCategoriesController::class, 'create']);
    Route::post('/blog-categories/store', [App\Http\Controllers\Admin\BlogCategoriesController::class, 'store'])->name('admin.blogcategory.store');
    Route::post('/blog-categories/update/{id}', [App\Http\Controllers\Admin\BlogCategoriesController::class, 'update'])->name('admin.blogcategory.update');
    Route::get('/blog-categories/edit/{id}', [App\Http\Controllers\Admin\BlogCategoriesController::class, 'edit']);
    Route::delete('/blog-categories/delete/{id}', [App\Http\Controllers\Admin\BlogCategoriesController::class, 'delete'])->name('admin.blogcategory.delete');
    
    Route::get('/blogs', [App\Http\Controllers\Admin\BlogsController::class, 'index'])->name('admin.blog');
    Route::get('/blogs/create', [App\Http\Controllers\Admin\BlogsController::class, 'create']);
    Route::post('/blogs/store', [App\Http\Controllers\Admin\BlogsController::class, 'store'])->name('admin.blog.store');
    Route::post('/blogs/update/{id}', [App\Http\Controllers\Admin\BlogsController::class, 'update'])->name('admin.blog.update');
    Route::get('/blogs/edit/{id}', [App\Http\Controllers\Admin\BlogsController::class, 'edit']);
    Route::delete('/blogs/delete/{id}', [App\Http\Controllers\Admin\BlogsController::class, 'delete'])->name('admin.blog.delete');
    
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings/store', [App\Http\Controllers\Admin\SettingsController::class, 'store'])->name('admin.setting.store');
    
    Route::get('/customers', [App\Http\Controllers\Admin\CustomersController::class, 'index'])->name('admin.customers');
    Route::get('/customers/view/{id}', [App\Http\Controllers\Admin\CustomersController::class, 'view']);
    
    Route::get('/transactions', [App\Http\Controllers\Admin\TransactionsController::class, 'index']);
    
    
    
    
    
});
