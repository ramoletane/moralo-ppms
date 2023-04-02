<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevelopmentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developmentMethods = [
            'Lectures and Workshops',
            'Coaching and Tutorials'
        ];
        foreach ($developmentMethods as $developmentMethod) {
            \App\Models\DevelopmentMethod::factory()->create([
                'method_name' => $developmentMethod,
            ]);    
        }
    }
}
