<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DeclarationController as AdminDeclarationController;
use App\Http\Controllers\Admin\ParentsController as AdminParentsController;
use App\Http\Controllers\Admin\FileController as AdminFileController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DeclarationsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

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
// ------------------------ CLIENTE --------------------------------------

Route::get('/', function () {
    return view('app.index');
})->name('index');

Route::post('/app', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

//----------- USUÁRIO -----------------
Route::get('app/painel/{document}', [UserController::class, 'index'])->name('dashboard');
Route::get('app/painel/{document}/create/{email}', [UserController::class, 'create'])->name('user.create');
Route::post('app/painel/{document}/store', [UserController::class, 'store'])->name('user.store');
Route::get('app/painel/{document}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('app/painel/{document}/update', [UserController::class, 'update'])->name('user.update');

//----------- DECLARAÇÃO -----------------
//Route::post('/app/painel/', [DeclarationsController::class, 'index'])->name('dashboard.index');
Route::post('/app/painel/store', [DeclarationsController::class, 'store'])->name('declaration.year.store');
Route::get('/app/painel/{document}/declaracao/{declaration}', [DeclarationsController::class, 'show'])->name('declaration.year');

//----------- ARQUIVOS -----------------
Route::get('/app/painel/{document}/declaracao/{declaration}/arquivos', [FileController::class, 'index'])->name('declaration.year.files');
Route::post('/app/painel/{document}/declaracao/{declaration}/arquivos/store', [FileController::class, 'store'])->name('declaration.year.files.store');



//----------- DEPENDENTES-----------------
Route::get('/app/painel/declaracao/{declaracao}/dependentes', [ParentsController::class, 'index'])->name('declaration.year.parents');
Route::post('/app/painel/declaracao/{declaracao}/dependentes/store', [ParentsController::class, 'store'])->name('declaration.year.parents.store');

//----------- DADOS BANCÁRIOS-----------------
Route::get('app/painel/{document}/dados-bancarios/{bank}', [BankController::class, 'index'])->name('user.bank');
Route::post('app/painel/{document}/dados-bancarios/{bank}/update', [BankController::class, 'update'])->name('user.bank.update');


// ------------------------ ADMIN --------------------------------------

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.do');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {

        Route::get('dashboard', [AdminUserController::class, 'index'])->name('admin.dashboard');

        Route::get('cliente/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('cliente/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('cliente/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::post('cliente/{id}', [AdminUserController::class, 'show'])->name('modal.user.show');
        Route::post('cliente/{id}/update', [AdminUserController::class, 'update'])->name('admin.user.update');

        Route::get('cliente/{id}/declaracoes', [AdminDeclarationController::class, 'show'])->name('admin.declarations.show');
        Route::get('cliente/{id}/declaracao/{declaration}', [AdminDeclarationController::class, 'index'])->name('admin.declarations.index');
        Route::post('cliente/{id}/declaracao/store', [AdminDeclarationController::class, 'store'])->name('admin.declarations.store');

        Route::get('cliente/{id}/declaracao/{declaration}/arquivos', [AdminFileController::class, 'index'])->name('admin.declaration.file.index');
        Route::post('cliente/{id}/declaracao/{declaration}/arquivos/store', [AdminFileController::class, 'store'])->name('admin.declaration.file.store');

        Route::get('cliente/{id}/declaracao/{declaration}/dependentes', [AdminParentsController::class, 'index'])->name('admin.declaration.parent');
        Route::post('cliente/{id}/declaracao/{declaration}/dependentes/store', [AdminParentsController::class, 'store'])->name('admin.declaration.parent.store');
    });
});
