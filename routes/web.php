<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('roles', RoleController::class)
    ->only(['index', 'store', 'update', 'destroy']);

Route::resource('users', UserController::class);
Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);
Route::get('users/{user}/active')
    ->uses('App\Http\Controllers\UserController@active')
    ->name('users.active');
