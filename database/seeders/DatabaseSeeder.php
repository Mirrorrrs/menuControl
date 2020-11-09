<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"admin",
            "password"=>Hash::make("admin")
        ]);

        Day::create([
            "day_name"=>"Monday"
        ]);
        Day::create([
            "day_name"=>"Tuesday"
        ]);
        Day::create([
            "day_name"=>"Wednesday"
        ]);
        Day::create([
            "day_name"=>"Thursday"
        ]);
        Day::create([
            "day_name"=>"Friday"
        ]);
        Day::create([
            "day_name"=>"Saturday"
        ]);

        Day::create([
            "day_name"=>"Sunday"
        ]);
    }
}
