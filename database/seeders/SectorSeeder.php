<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Industry;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industryIDs = Industry::pluck('id');

        \App\Models\Sector::factory()->create([
            'sector_name' => 'Software Engineering',
            'industry_id' => fake()->randomElement($industryIDs),
        ]);
    }
}
