<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\DevelopmentMethod;

class SkillDevelopmentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skillIDs = Skill::pluck('id');
        $developmentMethodIDs = DevelopmentMethod::pluck('id');

        \App\Models\SkillDevelopmentMethod::factory()->create([
            'skill_id' => fake()->randomElement($skillIDs),
            'development_method_id' => fake()->randomElement($developmentMethodIDs),
        ]);
    }
}
