<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Book::factory()
            ->count(50)
            ->make();

        $chunks = $users->chunk(25);

        foreach ($chunks as $chunk) {
            DB::table('books')->insert($chunk->toArray());
        }

    }
}