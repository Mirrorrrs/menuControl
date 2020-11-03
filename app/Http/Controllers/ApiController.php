<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Meal;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getMenu(Request $request)
    {
        $meal = collect(Day::where("day_name",$request->day_name)->with("meals")->first()->meals)->where("meal_type",$request->meal_type)->where("week",$request->day_order)->values()->first()->only("meals");
        return response()->json($meal);
    }

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
                    "week"=>$request->number
                ]);

            }
        });

        return redirect()->back();

    }
}
