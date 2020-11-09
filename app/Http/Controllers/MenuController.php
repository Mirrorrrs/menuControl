<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meal;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{

    public function save(Request $request)
    {
        $meals = collect($request->meals);
        $types = collect($request->types);
        $meals->keys()->each(function ($key) use ($meals,$types,$request){
            if(Meal::where("id",$key)->exists()){
                $meal = Meal::where("id",$key)->first();
                $meal->meals = $meals[$key];
                $meal->meal_type = $types[$key];
                $meal->save();
            }else{
                Meal::create([
                    "day_id"=>$request->day_id,
                    "meal_type"=>$types[$key],
                    "meals"=>$meals[$key],
                    "menu_id"=>$request->menu_id
                ]);

            }
        });

        return redirect()->back();

    }

   public function index(){
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $menus = \App\Models\Menu::where("user_id",$id)->get();
        return view("menus",[
            "menus"=>$menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            "menu_name" => "required|unique:menus,menu_name"
        ]);
        $menu_number = Menu::all()->count();
        if($val->fails()){
            return redirect()->back()->withErrors($val);
        }
        Menu::create([
           "user_id"=>Auth::user()->id,
           "menu_name"=>$request->menu_name,
            "menu_number"=>$menu_number,
        ]);

        return redirect()->back();
    }


   public function show ($menu_id)
   {
       if (\App\Models\Menu::where("id", $menu_id)->exists()) {
           $menu = collect(Day::with(["meals" => function ($query) use ($menu_id) {
               $query->where("menu_id", $menu_id);
           }])->get());
           $days = collect(Day::all());
           $menu = $menu->union($days);
           return view('menu', [
               "days" => $menu,
               "menu_id" => $menu_id
           ]);
       }

       return redirect()->back();
   }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }


    public function destroy($id)
    {
        Menu::where("id",$id)->delete();
        return redirect()->back();
    }
}
