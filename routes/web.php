<?php

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
// ------------------------ CLIENTE

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





// -------------------------


/*
Route::get('/app/panel/', [UserController::class, 'panel'])->name('dashboard.panel');


Route::get('/app', function () {
    return view('app.dashboard.index')->name('dashboard');
});

Route::resource('app/cliente/{cliente}/dados-bancarios', BankController::class);

Route::resource('app/cliente', UserController::class);

Route::resource('app/nova-declaracao', DeclarationController::class);

 */
