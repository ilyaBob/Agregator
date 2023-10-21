<?php

namespace Database\Seeders;

use App\Models\Admin\Cycle;
use Illuminate\Database\Seeder;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cycle::factory(15)->create();
    }
}
