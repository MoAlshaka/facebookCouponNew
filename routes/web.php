<?php

use App\Http\Controllers\Facebook\PageAccessController;
use App\Http\Controllers\Facebook\PostCouponController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['namespace'=>'User','prefix'=>'user','middleware'=>'auth:web'],function(){

    Route::get('page-access',[PageAccessController::class,'page_access_token'])->name('page_access_token');
    Route::post('get_page-access',[PageAccessController::class,'get_page_access_token'])->name('get_page_access_token');
    ///////////
    Route::get('post-coupon',[PostCouponController::class,'index'])->name('page_post');
    Route::post('post-coupon',[PostCouponController::class,'post'])->name('post_coupon');

});
require __DIR__.'/auth.php';