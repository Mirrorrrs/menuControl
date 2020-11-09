<?php

use App\Models\Day;
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

Route::middleware("auth")->group(function (){
    Route::get("/",[\App\Http\Controllers\MenuController::class,"index"])->name("all_menus");
    Route::get('/menu/{menu_id}',[\App\Http\Controllers\MenuController::class,"show"])->name("menu");
    Route::post("/menu/save",[\App\Http\Controllers\MenuController::class,"save"])->name("save-menu");
    Route::post("/menu/create",[\App\Http\Controllers\MenuController::class,"store"])->name("create-menu");
    Route::get("/menu/delete/{id}",[\App\Http\Controllers\MenuController::class,"destroy"])->name("delete-menu");
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/logout",[\App\Http\Controllers\Auth\LoginController::class,"logout"])->name("logout");
