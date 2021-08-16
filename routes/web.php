<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengunjungController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

// route::resource('blog', BlogController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => ['auth','checkRole:admin']], function () {
//     Route::get('/index', [BlogController::class, 'index'])->name('index');
//     Route::get('/tambah', [BlogController::class, 'create']);
//     Route::post('/simpan', [BlogController::class, 'store'])->name('simpan');
//     Route::delete('/delete{id}', [BlogController::class, 'destroy']);
//     Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
//     Route::put('/update/{id}', [BlogController::class, 'update'])->name('update');
// });
// Route::get('admin', function () { 
//     Route::get('/index', 'BlogController@index')->name('index');
// })->middleware('checkRole:admin');

Route::group(['middleware' => ['auth','checkRole:admin']], function () {
    Route::get('/index', [BlogController::class, 'index'])->name('index');
    Route::get('/tambah', [BlogController::class, 'create']);
    Route::post('/simpan', [BlogController::class, 'store'])->name('simpan');
    Route::delete('/delete{id}', [BlogController::class, 'destroy']);
    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [BlogController::class, 'update'])->name('update');
});

Route::group(['middleware' => ['auth','checkRole:pengunjung']], function () {
    Route::get('pengunjung', [PengunjungController::class, 'index'])->name('pengunjung');
});

// Route::get('pengunjung', function () { return view('pengunjung'); })->middleware('checkRole:pengunjung');


// Route::get('pengunjung','PengunjungController@index')->name('pengunjung')->middleware(['checkRole:admin,pengunjung']);
// Route::get('petugas', function () { return view('petugas'); });
