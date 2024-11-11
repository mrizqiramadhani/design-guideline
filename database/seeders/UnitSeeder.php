<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $units = [
            ['name' => 'Shafwah group'],
            ['name' => 'Shafwah holidays'],
            ['name' => 'Shafwah property']
        ];

        foreach ($units as $unit) {
            DB::table('units')->insert($unit);
        }
    }
}
