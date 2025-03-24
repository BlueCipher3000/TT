<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\ClassLike;

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

Route::middleware('auth')->group(function () {
    Route::get('/admin/quantri', function () {
        return view('admin.quantri');
    })->name('admin.quantri');

    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/qldanhmuc', [CategoryController::class, 'index'])->name('qldanhmuc.index');
    Route::get('/qldanhmuc/find', [CategoryController::class, 'find'])->name('qldanhmuc.find');

    Route::get('/qlsanpham', [ProductController::class, 'index'])->name('qlsanpham.index');
    Route::get('/qlsanpham/find', [ProductController::class, 'find'])->name('qlsanpham.find');

    Route::get('/themdanhmuc', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/qlkhachhang', [UserController::class, 'index'])->name('qlkhachhang.index');
    Route::get('/qlkhachhang/find', [UserController::class, 'find'])->name('qlkhachhang.find');
    Route::get('/qlkhachhang/create', [UserController::class, 'create'])->name('qlkhachhang.create');
    Route::get('/themkhachhang', function () {
        return view('usermanager.themkhachhang');
    })->name('themkhachhang');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('Login.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.index');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/forgotpassword', [ForgotPasswordController::class, 'index'])->name('forgotpassword.index');
Route::post('/forgotpassword/submit_token_to_email', [ForgotPasswordController::class, 'submit_token_to_email'])->name('forgotpassword.submit_token_to_email');
Route::get('/forgotpassword/submit_token_to_email/confirmcode/{user}', [ForgotPasswordController::class, 'confirmcode'])->name('forgotpassword.confirmcode');
Route::post('/forgotpassword/submit_token_to_email/confirmcode/check_confirmation_code/{user}', [ForgotPasswordController::class, 'check_confirmation_code'])
    ->name('forgotpassword.check_confirmation_code');
Route::get('/forgotpassword/submit_token_to_email/confirmcode/check_confirmation_code/forgotpassword/{user}', [ForgotPasswordController::class, 'forgotpassword'])
    ->name('forgotpassword.forgotpassword'); //route trả về view forgotpassword
Route::put('/forgotpassword/submit_token_to_email/confirmcode/check_confirmation_code/resetpassword/{user}', [ForgotPasswordController::class, 'resetpassword'])
    ->name('forgotpassword.resetpassword');

Route::post('/register/createaccout', [RegisterController::class, 'createaccout'])->name('register.createaccout');
Route::get('/email', [EmailController::class, 'sendemail'])->name('email.sendemail');

Route::fallback(function () {
    return 'Link không tồn tại';
});


Route::resources([
    'user' => UserController::class,
    'category' => CategoryController::class,
    'product' => ProductController::class,
]);
