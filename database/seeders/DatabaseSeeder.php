<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            GenreSeeder::class,
            ReaderSeeder::class,
            CycleSeeder::class,
            FileSeeder::class,
            NotificationSeeder::class,

            BookSeeder::class
        ]);
    }
}
