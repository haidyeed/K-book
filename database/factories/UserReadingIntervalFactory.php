<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserReadingIntervalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::get()->random()->id,
            'book_id' => $book_id = Book::get()->random()->id,
            'start_page' => $start_page = rand(1,$number_of_pages = Book::where('id',$book_id)->first()->number_of_pages),
            'end_page'=>rand($start_page,$number_of_pages)
        ];
    }

}
