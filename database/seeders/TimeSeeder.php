<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 11 ; $i < 24 ; $i++){
            $time = new Time();
            $time->start = $i;
            $time->end = $i+1;
            $time->capacity = random_int(0,3);
            $time->save();
        }
    }
}
