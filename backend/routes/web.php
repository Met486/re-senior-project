<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


Route::get('/welcome', function () {
    return view('welcome');
});


// ↓New

// Route::get('/', 'HomeController@index')->name('home');

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
    Route::get('/mypage',[UserController::class,'showMypage'])->name('users.mypage');
});

Route::get('/items/{id}',[ItemController::class,'showDetail'])->name('items.detail');
// TODO 欲しいの処理


Route::get('/users/{id}',[UserController::class,'showUser'])->name('users.user');

// scss test
Route::get('scss', function(){
    return view('for-scss');
});