<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pupeteer\ScrapController;
use App\Http\Controllers\Facebook\PageAccessController;
use App\Http\Controllers\Facebook\PageActiveController;
use App\Http\Controllers\Facebook\PostCouponController;
use App\Http\Controllers\Facebook\SharedPostController;
use App\Http\Controllers\Facebook\PostPageCouponController;

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

Route::group(['namespace'=>'User','prefix'=>'user','middleware'=> ['auth:web', 'max_execution_time']],function(){

    Route::get('page-access',[PageAccessController::class,'page_access_token'])->name('page_access_token');
    Route::post('get_page-access',[PageAccessController::class,'get_page_access_token'])->name('get_page_access_token');
    //page post in group
    Route::get('post-coupon',[PostCouponController::class,'index'])->name('page_post');
    Route::post('post-coupon',[PostCouponController::class,'post'])->name('post_coupon');

    //post in page
    Route::get('page-post-coupon',[PostPageCouponController::class,'index'])->name('page_post_it_self');
    Route::post('page-post-coupon',[PostPageCouponController::class,'post'])->name('page_post_coupon_it_self');

    ///share-post on group
    Route::get('share-post',[SharedPostController::class,'index'])->name('shared_post');
    Route::post('/share-post', [SharedPostController::class,'sharePost'])->name('share_post');
    ///share-post on page
    Route::get('share-page',[SharedPostController::class,'share_post_on_page'])->name('share_post_on_page');
    Route::post('/share-page', [SharedPostController::class,'sharePostPage'])->name('sharePostPage');
    ///page_comment
    Route::get('page-comment',[PageActiveController::class,'page_comment'])->name('view_page_comment');
    Route::post('/page-comment', [PageActiveController::class,'comment'])->name('page_comment');
    ///

////////////////////////////////////////////
    Route::get('scrap',[ScrapController::class,'scrap'])->name('scrap');
    Route::post('scrap',[ScrapController::class,'scrap_id'])->name('scrapid');
    //////
    Route::get('cookies',[ScrapController::class,'cookies'])->name('cookies');
    Route::post('cookies',[ScrapController::class,'add_cookies'])->name('add_cookies');
    //////
    Route::get('poster',[ScrapController::class,'poster'])->name('poster');
    Route::post('poster',[ScrapController::class,'group_poster'])->name('group_poster');
    //////
    Route::get('reels',[ScrapController::class,'reels'])->name('reels');
    Route::post('reels',[ScrapController::class,'uplode_reels'])->name('uplode_reels');
    //////


});
require __DIR__.'/auth.php';
