<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElements(['guru', 'bendahara'], $count = rand(1, 2)),
            'name' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('##############'),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
        ];
    }
}
