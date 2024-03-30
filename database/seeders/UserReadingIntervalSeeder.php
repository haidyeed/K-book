<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserReadingInterval;

class UserReadingIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = UserReadingInterval::factory()
            ->count(50)
            ->make();

        $chunks = $users->chunk(25);

        foreach ($chunks as $chunk) {
            DB::table('user_reading_intervals')->insert($chunk->toArray());
        }

    }
}