<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElliottController;
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
    return view('auth.login');
});


/* Route::get('/alumno', function () {
    return view('alumno.index');
});

Route::get('/alumno/create', [ElliottController::class,'create']);
*/

Route::resource('alumno', ElliottController::class)->middleware('auth');

Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [ElliottController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [ElliottController::class, 'index'])->name('home');
});
