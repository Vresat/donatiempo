<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/about',[ContactController::class,'index'])->name('about');
Route::post('/about',[ContactController::class,'store'])->name('storeAbout');    


Route::middleware('auth','is_admin')->group(function(){

    Route::get('/contact/{notification}',[ContactController::class,'show'])->name('adminContact');
    Route::get('/comments',[CommentsController::class,'index'])->name('adminCommentsIndex');
    Route::get('/comments/{comment}',[CommentsController::class,'show'])->name('adminCommentShow');
    Route::get('/comment/{comment}',[CommentsController::class,'edit'])->name('adminCommentEdit');
    Route::get('/users',[AnuncioController::class,'users'])->name('adminUser');
    Route::post('/users/{user}',[AnuncioController::class,'storeUser'])->name('adminStoreUser');
    Route::get('/users/{user}',[AnuncioController::class,'showUser'])->name('adminEditUser');
    Route::get('/admin',[AnuncioController::class,'index'])->name('adminIndex');
    Route::get('/table/actdes/{ad}',[AnuncioController::class,'actDesactivar'])->name('adminActDes');
    Route::get('/table/{ad}',[AnuncioController::class,'show'])->name('adminShow');
    Route::get('/category',[CategoryController::class,'create'])->name('adminCategory');
    Route::post('/category',[CategoryController::class,'store'])->name('adminCategory.store');
    Route::get('/category/{category:id}',[CategoryController::class,'actDesactivar'])->name('adminCategoryActDes');
});

Route::get('/', [AdController::class,'index'])->name('home');
Route::post('/filter', [AdController::class,'filterAd'])->name('orderBy');


Route::middleware('auth')->group(function(){
    
    Route::get('/close/{ad}',[AdController::class,'close'])->name('close');
    Route::delete('/close/{ad}',[AdController::class,'destroy'])->name('deleteAd');
    Route::post('/message/{ad}',[MessageController::class,'create'])->name('sendMessage');
    Route::post('/form',[AdController::class,'store'])->name('ads.store');
    Route::patch('/edit/{ad}',[AdController::class,'update'])->name('ads.update');
    Route::get('/delete/{ad}',[AdController::class,'deleteAd'])->name('userDeleteAd');
    Route::get('/user/table',[AdController::class,'table'])->name('user.table');
    Route::get('/user/table/{ad}/edit',[AdController::class,'edit'])->name('ad.edit');
    Route::get('/form',[AdController::class,'create'])->name('ads.forms');
    Route::get('/ad/{ad:name}/{sender?}',[AdController::class,'show'])->name('viewAd');
    Route::get('/ads/{category:id}',[AdController::class,'byCategory'])->name('by-category');
    Route::get('/{ad:name}/{sender?}',[AdController::class,'show'])->name('view');
});