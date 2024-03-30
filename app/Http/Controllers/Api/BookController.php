<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $books = Book::paginate(10, ['*'], 'bookpage');

        return response()->json([
            'success' => true,
            'message' => 'a list of all books',
            'data' => $books
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book;
        $book->name = $request->name;
        $book->author = $request->author;
        $book->number_of_pages = $request->number_of_pages;

        $book->save();

        return response()->json([
            'success' => true,
            'message' => 'a new book has been added successfully',
            'data' => $book
        ], 200);

    }

}