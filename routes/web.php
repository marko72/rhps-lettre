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
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', "Admin\AdminController@showStatistic")->name('admin');

    Route::resource('posts',"Admin\PostController");
    Route::post('/posts/paginate/{id}',"Admin\PostController@paginate");
    Route::resource('categories',"Admin\CategoryController");
    Route::get('/statistics',"Admin\AdminController@showStatistic")->name('statistic');
    Route::post('/statistics/{br}',"Admin\AdminController@paginate");
    Route::post('/statistics/date/{br}',"Admin\AdminController@paginateByDate");
    Route::resource('adminUsers', 'Admin\AdminUsersController')->except([
        'create', 'store', 'show', 'edit'
    ]);
});

//DEO SAJTA ZA KORISNIKE

Route::get('/','FrontendController@index');
Route::get('/home','FrontendController@index')->name('home');
Route::get('/login','FrontendController@login')->name('showLogin');
Route::post('/login','LogRegController@login')->name('login');
Route::get('/logout','LogRegController@logout')->name('logout')->middleware('isLogged');
Route::get('/news/{id}',"FrontendController@singleNews")->name('single.news');
Route::get('/autor',"FrontendController@autor")->name('autor');
Route::post('/comment', "FrontendController@comment")->name('leave.comment')->middleware('isLogged');
Route::post('/uncomment', "FrontendController@uncomment")->name('delete.comment')->middleware('isLogged');
Route::get('/news',"FrontendController@news")->name('news');
Route::post('/news/paginate/{pg}',"FrontendController@paginateNews");
Route::get('/news/category/{id}',"FrontendController@newsByCategory")->name('news.category');
Route::post('/news/search/{pg}',"FrontendController@searchNews");


Route::resource('user','UserController');


Route::get("/contact",'SendEmailController@index')->name('contact');
Route::post("/contact/sendemail",'SendEmailController@send')->name('send.email');
