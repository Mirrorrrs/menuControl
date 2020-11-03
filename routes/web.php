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

Route::get('/{week}', function ($week) {
    $menu = Day::with("meals")->get();
    foreach ($menu as $day){
        $day->this_week_meals = collect($day->meals)->where("week",$week);
    }
    return view('home',[
        "days"=>$menu,
        "week_id"=>$week
    ]);
});


Route::post("/save",[\App\Http\Controllers\ApiController::class,"save"])->name("save-day");
