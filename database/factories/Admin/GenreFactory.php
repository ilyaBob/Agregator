<?php

namespace Database\Factories\Admin;

use App\Services\TransliterationService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $slug = TransliterationService::generateSlug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'is_active' => rand(0, 1)
        ];
    }
}
