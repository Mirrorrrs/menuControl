<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meal;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getMenu(Request $request)
    {
        $meal = collect(Meal::whereHas("day",function ($query) use($request){
            $query->where("day_name",$request->day_name);
        })->whereHas("menu",function($query)use($request){
            $query->where("menu_number",$request->menu_id);
        })->where("meal_type",$request->meal_type)->first());
        return response()->json($meal);
    }
}
