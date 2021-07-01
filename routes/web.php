<?php

use Illuminate\Support\Facades\{Route, };
use App\Http\Controllers\CapteurController;

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

Route::get('/', [CapteurController::class, 'index']);
Route::get('/update/{id}', [CapteurController::class, 'update']);
Route::post('/add', [CapteurController::class, 'add']);
Route::get('/capteur/{id}', [CapteurController::class, 'delete']);
