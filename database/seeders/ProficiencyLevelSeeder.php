<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProficiencyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProficiencyLevel::factory()->create([
            'level_name' => 'Basic',
            'level_description' => 'Basic Level represents a reactive behavior. This behaviour is usually in response to a situation and may be influenced or prompted by someone else, such as a supervisor or a client.',
        ]);
    }
}
