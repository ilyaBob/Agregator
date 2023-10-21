<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Cycle;
use App\Models\Admin\Genre;
use App\Services\TransliterationService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(3, true);
        $slug = TransliterationService::generateSlug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'is_active' => rand(0,1),
            'age' => rand(1990, 2023),
            'cycle_number' => rand(1, 100),
            'time' => $this->faker->time(),
            'cycle_id' => Cycle::all()->random(1)->pluck('id')->first(),
            'description' => $this->faker->text(),
            'image' => $this->faker->image(),
            'genre_slug' => Genre::getGenres()->random(1)->pluck('slug')->first(),
            'link_to_original' => 'no',
        ];
    }
}
