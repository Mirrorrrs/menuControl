<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function meals()
    {
        return $this->hasMany(Meal::class, "day_id", "id");
    }

}
