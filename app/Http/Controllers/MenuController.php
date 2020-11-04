<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Menu::create([
           "user_id"=>Auth::user()->id,
           "menu_name"=>$request->menu_name
       ]);

       return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
