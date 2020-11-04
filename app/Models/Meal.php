<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function day()
    {
        return $this->belongsTo(Day::class, "id", "day_id");
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, "id", "menu_id");
    }


    public static function getMealName($type)
    {
        switch ($type){
            case 1:
                return "Завтрак";
            case 2:
                return "Второй Завтрак";
            case 3:
                return "Обед";
            case 4:
                return "Полдник";
            case 5:
                return "Ужин";
        }

    }

}
