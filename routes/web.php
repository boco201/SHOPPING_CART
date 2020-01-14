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

Route::get('/', 'Site\ProductController@homepage')->name('site.pages.homepage');
Route::get('/category/{slug}', 'Site\CategoryController@show')->name('category.show');
Route::get('/product/{slug}', 'Site\ProductController@show')->name('product.show');

Route::get('/contact', 'Site\ContactFormController@create')->name('contact.create');
Route::post('/contact', 'Site\ContactFormController@store');
//Route::get('/cgv', 'ContactFormController@cgv')->name('cgv');
//Route::get('/cgu', 'ContactFormController@cgu')->name('cgu');

Route::post('/product/add/cart', 'Site\ProductController@addToCart')->name('product.add.cart');
Route::get('/cart', 'Site\CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'Site\CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('checkout.cart.clear');

Route::get('/search', 'Site\ProductController@search')->name('searchProducts');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout');
    Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');

    Route::get('/paypalcheckout', 'Site\CheckoutController@paypalcheckout')->name('paypalcheckout');
    Route::post('/paypalcheckout/order', 'Site\CheckoutController@placeOrderPaypal')->name('checkout.place.order.paypal');

    Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');

    Route::post('/products/comments', 'Site\CommentsController@store')->name('products.comments.store');

    Route::get('/products/comments/{product}', 'Site\CommentsController@show');
});

Auth::routes();
require 'admin.php';
