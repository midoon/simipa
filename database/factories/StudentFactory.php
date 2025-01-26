<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => null, // Akan diisi dalam Seeder
            'name' => $this->faker->name,
            'nisn' => $this->faker->unique()->numerify('##############'),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
        ];
    }
}
