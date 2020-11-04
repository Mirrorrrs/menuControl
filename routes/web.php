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
    Route::get("/",function (){
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $menus = \App\Models\Menu::where("user_id",$id)->get();
        return view("menus",[
            "menus"=>$menus
        ]);
    })->name("all_menus");

    Route::get('/menu/{menu_id}', function ($menu_id) {
        if(\App\Models\Menu::where("id",$menu_id)->exists()){
            $menu =collect( Day::with(["meals"=> function ($query) use ($menu_id){
                $query->where("menu_id",$menu_id);
            }])->get());
            $days =collect(Day::all());
            $menu = $menu->union($days);
            return view('menu',[
                "days"=>$menu,
                "menu_id"=>$menu_id
            ]);
        }

        return redirect()->back();

    })->name("menu");


    Route::post("/menu/save",[\App\Http\Controllers\MenuController::class,"save"])->name("save-menu");
    Route::post("/menu/create",[\App\Http\Controllers\MenuController::class,"store"])->name("create-menu");
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/logout",function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route("login");
})->name("logout");
