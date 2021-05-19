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


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::post('/sendemail', [App\Http\Controllers\ClientEmailsController::class, 'store'])->name('welcome-sendemail');
Route::get('/terms', [App\Http\Controllers\WelcomeController::class, 'terms'])->name('terms');

Auth::routes(['verify' => true]);

# Online Shop
Route::get('/online-shop', [App\Http\Controllers\OnlineShop\ShopController::class, 'index'])->name('online-shop.index');
Route::get('/online-shop/product-listing', [App\Http\Controllers\OnlineShop\ShopController::class, 'product_listing_index'])->name('online-shop.product-listing');
Route::get('/online-shop/product-listing/product-detail/{product}', [App\Http\Controllers\OnlineShop\ShopController::class, 'product_detail_index'])->name('online-shop.product-detail');

// Filters
Route::get('/online-shop/product-listing/{collection}/{type}/{price}', [App\Http\Controllers\OnlineShop\ShopController::class, 'product_filter'])->name('online-shop.filter');

// User Cart
Route::get('/online-shop/cart', [App\Http\Controllers\OnlineShop\CartController::class, 'index'])->name('online-shop.cart');
Route::get('/online-shop/cart/checkout', [App\Http\Controllers\OnlineShop\CartController::class, 'checkout'])->name('online-shop.checkout');

Route::post('/online-shop/cart/checkout/orderconfirmation', [App\Http\Controllers\OnlineShop\OrderController::class, 'store'])->name('online-shop.create-order');
Route::get('/online-shop/cart/checkout/orderconfirmation/{order}/{delivery}/{billing}', [App\Http\Controllers\OnlineShop\OrderController::class, 'confirmation'])->name('online-shop.order-confirmation');

// Cart Actions
Route::post('/online-shop/product-listing/product-detail/{product}/{userId}', [App\Http\Controllers\OnlineShop\CartController::class, 'store'])->name('online-shop.add-to-cart');
Route::patch('/online-shop/cart/{productId}/{quantity}', [App\Http\Controllers\OnlineShop\CartController::class, 'update'])->name('online-shop.update-cart');
Route::delete('/online-shop/cart/{productId}', [App\Http\Controllers\OnlineShop\CartController::class, 'destroy'])->name('online-shop.delete-cart');

//User Profile
Route::get('/online-shop/profile', [App\Http\Controllers\OnlineShop\ProfileController::class, 'index'])->name('online-shop.profile-index');
Route::get('/online-shop/profile/personal', [App\Http\Controllers\OnlineShop\ProfileController::class, 'personal_index'])->name('online-shop.profile-personal');

// User Addresses
Route::get('/online-shop/profile/addresses', [App\Http\Controllers\OnlineShop\ProfileController::class, 'addresses_index'])->name('online-shop.profile-addresses');
Route::get('/online-shop/profile/addresses/create', [App\Http\Controllers\OnlineShop\BillingController::class, 'addresses_create'])->name('online-shop.create-addresses');
Route::post('/online-shop/profile/addresses/{user}', [App\Http\Controllers\OnlineShop\BillingController::class, 'addresses_store'])->name('online-shop.store-addresses');

Route::get('/online-shop/profile/addresses/{address}/edit', [App\Http\Controllers\OnlineShop\BillingController::class, 'addresses_edit'])->name('online-shop.edit-addresses');
Route::patch('/online-shop/profile/addresses/{address}', [App\Http\Controllers\OnlineShop\BillingController::class, 'addresses_update'])->name('online-shop.update-addresses');

// User Orders
Route::get('/online-shop/profile/orders', [App\Http\Controllers\OnlineShop\ProfileController::class, 'orders_index'])->name('online-shop.profile-orders');
Route::get('/online-shop/profile/orders/{order}', [App\Http\Controllers\OnlineShop\OrderController::class, 'show'])->name('online-shop.show-orders');

# Backoffice
Route::get('/backoffice', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Backoffice - User Profile
Route::get('/backoffice/profile', [App\Http\Controllers\Backoffice\ProfileController::class, 'index'])->name('backoffice.profile');

Route::patch('/backoffice/users/{user}', [App\Http\Controllers\Backoffice\UsersController::class, 'update'])->name('users.update');

// Backoffice - Users/Administrator
Route::get('/backoffice/users/clients', [App\Http\Controllers\Backoffice\UsersController::class, 'client'])->name('users.client');
Route::get('/backoffice/users/administrators', [App\Http\Controllers\Backoffice\UsersController::class, 'administrator'])->name('users.administrator');

Route::patch('/backoffice/users/{user}', [App\Http\Controllers\Backoffice\UsersController::class, 'update'])->name('users.update');

// Backoffice - Products
Route::get('/backoffice/products', [App\Http\Controllers\Backoffice\ProductsController::class, 'index'])->name('products.index');
Route::get('/backoffice/products/create', [App\Http\Controllers\Backoffice\ProductsController::class, 'create'])->name('products.create');
Route::get('/backoffice/products/create/getInfo/{collection}/{type}', [App\Http\Controllers\Backoffice\ProductsController::class, 'getInfo'])->name('products.get-info');

Route::post('/backoffice/products', [App\Http\Controllers\Backoffice\ProductsController::class, 'store'])->name('products.store');

Route::get('/backoffice/products/{product}/edit', [App\Http\Controllers\Backoffice\ProductsController::class, 'edit'])->name('products.edit');
Route::patch('/backoffice/products/{product}', [App\Http\Controllers\Backoffice\ProductsController::class, 'update'])->name('products.update');

Route::delete('/backoffice/products/{product}/{imageName}', [App\Http\Controllers\Backoffice\ImageController::class, 'destroy'])->name('image.delete');

// Backoffice - Collections
Route::get('/backoffice/collections', [App\Http\Controllers\Backoffice\CollectionsController::class, 'index'])->name('collections.index');
Route::get('/backoffice/collections/create', [App\Http\Controllers\Backoffice\CollectionsController::class, 'create'])->name('collections.create');

Route::post('/backoffice/collections', [App\Http\Controllers\Backoffice\CollectionsController::class, 'store'])->name('collections.store');

Route::get('/backoffice/collections/{collection}/edit', [App\Http\Controllers\Backoffice\CollectionsController::class, 'edit'])->name('collections.edit');
Route::patch('/backoffice/collections/{collection}/{disable?}', [App\Http\Controllers\Backoffice\CollectionsController::class, 'update'])->name('collections.update');

// Backoffice - Types
Route::get('/backoffice/types', [App\Http\Controllers\Backoffice\TypesController::class, 'index'])->name('types.index');
Route::get('/backoffice/types/create', [App\Http\Controllers\Backoffice\TypesController::class, 'create'])->name('types.create');

Route::post('/backoffice/types', [App\Http\Controllers\Backoffice\TypesController::class, 'store'])->name('types.store');

Route::get('/backoffice/types/{type}/edit', [App\Http\Controllers\Backoffice\TypesController::class, 'edit'])->name('types.edit');
Route::patch('/backoffice/types/{type}/{disable?}', [App\Http\Controllers\Backoffice\TypesController::class, 'update'])->name('types.update');

// Backoffice - Addresses
Route::get('/backoffice/addresses', [App\Http\Controllers\Backoffice\AddressesController::class, 'index'])->name('addresses.index');

// Backoffice - Orders
Route::get('/backoffice/orders', [App\Http\Controllers\Backoffice\OrdersController::class, 'index'])->name('orders.index');
Route::get('/backoffice/orders/{order}', [App\Http\Controllers\Backoffice\OrdersController::class, 'show'])->name('orders.show');