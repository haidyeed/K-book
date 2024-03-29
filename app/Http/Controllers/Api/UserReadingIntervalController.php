<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserReadingIntervalRequest;
use App\Models\UserReadingInterval;

class UserReadingIntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $userReadingIntervals = UserReadingInterval::paginate(10, ['*'], 'user-reading-intervalpage');

        return response()->json([
            'success' => true,
            'message' => 'a list of all books',
            'data' => $$userReadingIntervals
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
    public function store(StoreUserReadingIntervalRequest $request)
    {
        $samePreviousInterval = UserReadingInterval::where([
            ['user_id',$request->user_id],
            ['book_id',$request->book_id],
            ['start_page',$request->start_page],
            ['end_page',$request->end_page],
        ])->first();

        if($samePreviousInterval){
            return response()->json([
                'success' => false,
                'message' => 'this interval has been read before'
            ], 200);
        }

        $userReadingInterval = new UserReadingInterval;
        $userReadingInterval->user_id = $request->user_id;
        $userReadingInterval->book_id = $request->book_id;
        $userReadingInterval->start_page = $request->start_page;
        $userReadingInterval->end_page = $request->end_page;

        $userReadingInterval->save();

        return response()->json([
            'success' => true,
            'message' => 'a new user reading interval has been added successfully',
            'data' => $userReadingInterval
        ], 200);

    }

}