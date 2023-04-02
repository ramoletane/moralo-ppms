<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkillDevelopmentMethod>
 */
class SkillDevelopmentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'skill_id' => fake()->randomDigit(),
            'development_method_id' => fake()->randomDigit(),
        ];
    }
}
