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
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/find', [CategoryController::class, 'find'])->name('category.find');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/find', [ProductController::class, 'find'])->name('product.find');

    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resources([
        'user' => UserController::class,
        'category' => CategoryController::class,
        'product' => ProductController::class,
    ]);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/find', [UserController::class, 'find'])->name('user.find');
    Route::get('/user/add', function () {
        return view('user.add');
    })->name('user.add');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('Login.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.index');

/* Route::get('/register', [RegisterController::class, 'index'])->name('register');
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
 */
Route::fallback(function () {
    return view('errors.404');
});



