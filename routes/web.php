<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;


Route::get('/', [AuthController::class,'main'])->name('home');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/login', function () {
    return view('auth.loginUser');
})->name('login');

Route::get('/register', function () {
    return view('auth.registerUser');
})->name('register');

Route::post('/userCheck', [AuthController::class, 'user_check'])->name('userCheck');
Route::post('/userRegister', [AuthController::class, 'user_register'])->name('userRegister');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/product/addCart', [CartController::class, 'add_to_cart'])->name('addCart');

Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('/deleteItem_cart', [CartController::class, 'deleteItem_cart'])->name('deleteItem_cart');
Route::post('/updateQuantity_cart', [CartController::class, 'updateQuantity_cart'])->name('updateQuantity_cart');
Route::post('/create-razorpay-payment', [PaymentController::class, 'createRazorpayPayment'])->name('createRazorpayPayment');
Route::post('/add_order', [OrderController::class, 'add_order'])->name('add_order');
Route::get('/myorders', [OrderController::class, 'index'])->name('myorders');


Route::get('/myorders/{id}', [OrderController::class, 'viewOrder'])->name('viewOrder');
Route::post('/add_address', [AddressController::class, 'add_address'])->name('add_address');

Route::post('/myorders/{order}', [OrderController::class, 'cancel_order'])->name('cancel_order');

Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel_order'])->name('cancel_order');


Route::post('/orders/{order}/shipped', [OrderController::class, 'update_shipped'])->name('update_shipped');



Route::get('/profile', [AccountController::class, 'show_profile'])->name('profile');

Route::post('/profile/reset-password', [AccountController::class, 'resetPassword'])->name('reset_password');
Route::post('/profile/update-account', [AccountController::class, 'updateAccount'])->name('updateAccount');

Route::post('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('admin');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('admin');


Route::get('/order/{order_id}', [AdminController::class, 'show'])->name('order.details');

Route::get('/adminproducts', [AdminController::class, 'products'])->name('adminproducts')->middleware('admin');
Route::get('/all-orders', [AdminController::class, 'orders'])->name('all-orders')->middleware('admin');
Route::get('/users', [AdminController::class, 'all_users'])->name('users')->middleware('admin');
Route::get('/add-product',[ProductController::class,'add_product'])->name('add-product')->middleware('admin');

Route::post('/product-submit',[ProductController::class,'product_submit'])->name('product-submit')->middleware('admin');
Route::post('/product-update',[ProductController::class,'product_update'])->name('product-update')->middleware('admin');
Route::post('/delete_product',[ProductController::class,'delete_product'])->name('delete_product')->middleware('admin');
Route::post('/reactivate_product',[ProductController::class,'reactivate_product'])->name('reactivate_product')->middleware('admin');

Route::get('/edit/{id}',[ProductController::class,'edit_product'])->middleware('admin');
Route::post('/remove-image',[ProductController::class,'remove_image'])->middleware('admin');

Route::post('/block-user',[AuthController::class,'block_user'])->middleware('admin');
Route::post('/reactivate-user',[AuthController::class,'reactivate_user'])->middleware('admin');

Route::get('/casual',[ProductController::class,'casual'])->name('casual');
Route::get('/sneakers',[ProductController::class,'sneakers'])->name('sneakers');
Route::get('/sports',[ProductController::class,'sports'])->name('sports');
Route::get('/formal',[ProductController::class,'formal'])->name('formal');
Route::get('/men',[ProductController::class,'men'])->name('men');
Route::get('/women',[ProductController::class,'women'])->name('women');