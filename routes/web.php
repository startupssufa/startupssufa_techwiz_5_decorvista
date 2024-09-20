<?php

use App\Http\Controllers\decorvista; 
use App\Http\Controllers\seller_contact_view; 
use Illuminate\Support\Facades\Route;

// Route for the homepage (index)
Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('auth/register');
})->name('register');

// Route for the page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route for the blog page
Route::get('/product', function () {
    return view('product');
})->name('product');


// Route for the contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route for the project page
Route::get('/project', function () {
    return view('project');
})->name('project');

// Route for the services page
Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/admin-product', function () {
    return view('product');
})->name('admin-product');

Route::get('/product-dashboard', function(){
    return view('product-dashboard');
})->name('product-dashboard');

Route::get('/dashboard-seller-add', function(){
    return view('dashboard-seller/dashboard-pages/Products/Add_seller');
})->name('seller-icon');

Route::get('/dashboard-seller-auth',[decorvista::class,'authdata']);

Route::get('/dashboard-seller-view',[decorvista::class, 'seller_view']);

Route::get('/dashboard-table',[decorvista::class,'show']);

Route::get('/delete/{dlid}',[decorvista::class, 'delete']);

Route::get('/update/{uid}',[decorvista::class, 'update']);

Route::post('/updateconfirm/{uid}', [decorvista::class, 'updateconfirm']);

Route::get('/pr_delete/{pr_dl}',[decorvista::class, 'pr_delete']);

Route::get('/auth_delete/{at_dl}',[decorvista::class,'at_delete']);

Route::get('/at_update/{atuid}',[decorvista::class,'at_update']);

Route::post('/at_update_confirm/{atuid}',[decorvista::class,'at_update_confirm']);

Route::get('/pr_update/{pr_u}',[decorvista::class, 'pr_update']);

Route::post('/pr_updateconfirm/{pr_u}', [decorvista::class, 'pr_updateconfirm']);

Route::post('/productinsert', [decorvista::class, 'productinsert']);

Route::post('/seller-contact-view',[decorvista::class, 'contact_view']);

Route::get('/products', [decorvista::class, 'productuserinsert']);

Route::get('/seller-table-compact', [decorvista::class, 'seller_table_compact']);

Route::get('/admin-seller-table-compact',[decorvista::class, 'admin_seller_table_compact']);

Route::get('/dashboard-contact-seller',[decorvista::class, 'contact']);

Route::post('/AtcPro',[decorvista::class,'addtocart1']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::User()->role==1){
            return view('index');
            }
            elseif(Auth::User()->role==2){
                return view('dashboard-index');
            }
            else{
            return view('product-dashboard');
            }

    });
});