<?php

namespace Database\Seeders;

use App\Models\Admin\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::factory(50)->create();
    }
}
