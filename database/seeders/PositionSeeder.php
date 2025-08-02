<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;


class PositionSeeder extends Seeder
{
    public function run()
    {
        Position::firstOrCreate(['name' => 'JEFE']);
       
      
    }
}
