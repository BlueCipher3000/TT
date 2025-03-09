<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::get('/login',function ()  {
    return view('login.login');
})->name('login');

Route::post('/login', [LoginController::class,'index'])->name('login.index');
Route::get('/quantri', function () {
    return view('admin.quantri');
});
Route::get('/qlkhachhang',[UserController::class,'index'])->name('qlkhachhang.index');
Route::get('/qlkhachhang/find',[UserController::class,'find'])->name('qlkhachhang.find');

Route::get('/qldanhmuc',[CategoryController::class,'index'])->name('qldanhmuc.index');
Route::get('/qldanhmuc/find',[CategoryController::class,'find'])->name('qldanhmuc.find');

Route::get('/qlsanpham',[ProductController::class,'index'])->name('qlsanpham.index');
Route::get('/qlsanpham/find',[ProductController::class,'find'])->name('qlsanpham.find');

Route::get('/themkhachhang',function (){
    return view('usermanager.themkhachhang');
})->name('themkhachhang');
Route::get('/themdanhmuc',[CategoryController::class,'create'])->name('category.create');
Route::resources([
    'khachhang' => UserController::class,
    'category' => CategoryController::class,
    'product' => ProductController::class,
]);
