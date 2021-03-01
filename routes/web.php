<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Auth;

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

Route::get('/', function () {
     return redirect('login');
});

Auth::routes();





Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::group(['middleware'=> 'admin'], function(){
        Route::get('admin',[AdminController::class,'index'])->name('admin');
        Route::get('/users',[AdminController::class, 'users'])->name('users');
        Route::get('/user/change-role/{id}',[AdminController::class, 'changeRole'])->name('change-role');
        Route::get('/resources',[AdminController::class, 'resources'])->name('resources');
        Route::get('/resource/generate-pdf/{id}', [ResourceController::class, 'pdf'])->name('generate_pdf');
    });
    Route::group(['middleware'=> 'user'], function(){
        Route::get('user',[UserController::class,'index'])->name('user');
        Route::post('user/resource',[ResourceController::class,'store'])->name('store-resource');
    });
});