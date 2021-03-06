<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;



Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/search',[SearchController::class,'index'])->name('search');



Route::get('/items/{id}/edit',[ItemController::class,'showEditForm'])->name('items.edit');
Route::post('/items/{id}/edit',[ItemController::class,'edit']);


Route::get('/',[HomeController::class,'index'])->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/items/sell',[ItemController::class,'showSellForm'])->name('items.sell');
    Route::post('/items/sell',[ItemController::class,'sell']);
    Route::delete('/items/{id}', [ItemController::class,'delete'] )->name('items.destroy');
    Route::put('/items/{id}/buy', [ItemController::class,'buy'] )->name('items.buy');
    Route::put('/items/{id}/trade', [ItemController::class,'trade'] )->name('items.trade');
    Route::get('/items/{id}/add_comment',[ItemController::class,'showAddCommentForm'])->name('items.addComment');
    Route::patch('/items/{id}/add_comment',[ItemController::class,'addComment']);
    Route::patch('/items/{id}/send',[ItemController::class,'send'])->name('items.send');
    Route::post('/items/{id}/evaluation',[EvaluationController::class,'create'])->name('evaluation.create');

    // 以下マイページ機能
    Route::get('/mypage',[UserController::class,'showMypage'])->name('users.mypage.mypage');
    Route::get('/mypage/listings/listing',[UserController::class,'showSellingList'])->name('users.mypage.listings.listing');
    Route::get('/mypage/listings/in_progress',[UserController::class,'showInProgressList'])->name('users.mypage.listings.in_progress');
    Route::get('/mypage/listings/with_comment',[UserController::class,'showWithCommentList'])->name('users.mypage.listings.with_comment');
    Route::get('/mypage/listings/completed',[UserController::class,'showCompletedList'])->name('users.mypage.listings.completed');
    Route::get('/mypage/listings/buyed',[UserController::class,'showCompletedList'])->name('users.mypage.listings.buyed');

});

Route::get('/items/{id}',[ItemController::class,'showDetail'])->name('items.detail');
//削除


Route::get('/users/{id}',[UserController::class,'showUser'])->name('users.user');

// scss test
Route::get('scss', function(){
    return view('for-scss');
});

Route::get('admin',[SearchController::class,'listItem'])->name('admin');

Route::get('items/getSubCategory/{id}',[ItemController::class,'getSubCategory'])->name('getSubCategory');


// TODO 欲しいの処理