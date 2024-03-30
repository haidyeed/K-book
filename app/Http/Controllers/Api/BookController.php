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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     *
     */
    public function update($request,$id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book= Book::find($id);

       if($book){

        return response()->json([
            'success' => true,
            'message' => 'Book',
            'data' => $book
        ], 200);

       }

       return response()->json([
        'success' => false,
        'message' => 'this Book is not found',
       ], 404);

    }


    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if ($book){
            if($book->delete()){

                return response()->json([
                    'success' => true,
                    'message' => 'Book deleted successfully'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Bad request, this Book is not deleted'
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'this Book is not found'
        ], 404);
    }

}