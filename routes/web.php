<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

//principal
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Articulos

Route::resource('articles', ArticleController::class)
                ->except('show')
                ->names('articles');
// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

//categorías
Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');

//comentarios
Route::resource('comments', CommentController::class)
                ->only('index', 'destroy')
                ->names('comments');

 //perfiles
Route::resource('profiles', ProfileController::class)
                ->only('edit', 'update')
                ->names('profiles');

Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');
Route::get('/comment', [CommentController::class, 'store'])->name('comments.store');

Auth::routes();
