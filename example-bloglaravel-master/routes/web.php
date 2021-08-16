<?php

use Illuminate\Support\Facades\Route;
// use App\Models\Data;
use App\Http\Controllers\DataController;
//use App\Http\Middleware\CheckRole;
// use Auth;

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
    return view('welcome');
});

Route::get('/index', [DataController::class, 'index']);
Route::get('/tambah', [DataController::class, 'tambah']);
Route::post('/simpan', [DataController::class, 'simpan'])->name('simpan_data');
Route::delete('/delete{id}', [DataController::class, 'delete']);
Route::get('/edit/{id}', [DataController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [DataController::class, 'update'])->name('update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('penulis', function () { return view('penulis'); })->middleware(['checkRole:admin,penulis']);
Route::get('pembaca', function () { return view('pembaca'); })->middleware('checkRole:pembaca');
