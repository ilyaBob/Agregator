<?php

namespace Database\Seeders;

use App\Models\Admin\Genre;
use App\Services\TransliterationService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Аниме',
            'фентези',
            'Фантастика',
            'Альтернативная история',
            'Киберпанк',
            'Короткие рассказы',
            'ЛитРПГ',
            'Попаданцы',
            'Постапокалипсис',
            'Стимпанк',
            'Ужасы/Мистика',
        ];

        foreach ($data as $item){
            $slug = TransliterationService::generateSlug($item);
            Genre::factory()->create([
                'name' => $item,
                'slug' => $slug,
                'is_active' => rand(0, 1)
            ]);
        }


    }
}
