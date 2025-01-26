<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $gradeName = Grade::inRandomOrder()->first()?->name ?? 'Kelas';
        $alphabet = $this->faker->randomElement(range('A', 'Z'));

        return [
            'grade_id' => null, // Akan diisi dalam Seeder
            'name' => "{$gradeName}-{$alphabet}",
        ];
    }
}
