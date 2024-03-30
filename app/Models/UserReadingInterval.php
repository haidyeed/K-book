<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReadingInterval extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "book_id",
        "start_page",
        "end_page"
    ];

}