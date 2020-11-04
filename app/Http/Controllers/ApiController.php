<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meal;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getMenu(Request $request)
    {
        $meal = collect(Day::where("day_name",$request->day_name)->with("meals")->first()->meals)->where("meal_type",$request->meal_type)->where("menu_id",$request->menu_id)->values()->first()->only("meals");
        return response()->json($meal);
    }
}
