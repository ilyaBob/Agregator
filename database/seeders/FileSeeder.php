<?php

namespace Database\Seeders;

use App\Models\Admin\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//1.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//2.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//3.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//4.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//5.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//6.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//7.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//8.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//9.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//10.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//11.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//12.mp3',
            'https://m1.audioknigi.xyz//a//y//4a9c1029fa505863//mp3//13.mp3',
        ];

        foreach ($data as $key => $item) {
            File::factory()->create([
                'title' => $key,
                'file' => $item,
            ]);
        }
    }
}
