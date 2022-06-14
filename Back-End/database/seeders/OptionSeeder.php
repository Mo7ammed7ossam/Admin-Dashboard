<?php

namespace Database\Seeders;

use App\Models\Options;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Options::create([
            'massage_therapy' => 0,
            'chiropractic_care' => 0,
            'yoga_exercise' => 0,
            'others' => 0
        ]);
    }
}
