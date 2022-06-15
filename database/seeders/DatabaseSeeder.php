<?php

namespace Database\Seeders;

use App\Models\Downloadable;
use App\Models\Snippet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Downloadable::truncate();
        Snippet::truncate();

        Downloadable::factory(50)->create();
        Snippet::factory(50)->create();
    }
}
