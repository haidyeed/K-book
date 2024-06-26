<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserReadingIntervalRequest;
use App\Models\User;
use App\Models\UserReadingInterval;
use App\Services\BookService;
use App\Services\SMSService\SMSProviderContext;
use Illuminate\Support\Facades\Log;
use Throwable;

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
            'message' => 'a list of all reading intervals',
            'data' => $userReadingIntervals
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

        $smsProvider = config('sms.sms_provider');

        try {
            $user=User::find($request->user_id);
            $provider = new SMSProviderContext($smsProvider);
            $provider->send($user);
        } catch (Throwable $th) {
            Log::channel('api')->info("sms provider error: $th");
        }

        return response()->json([
            'success' => true,
            'message' => 'a new user reading interval has been added successfully',
            'data' => $userReadingInterval
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topRecommendedBooks()
    {
        $bookService = new BookService();
        return $bookService->topRecommendedBooks();
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
        $userReadingInterval= UserReadingInterval::find($id);

       if($userReadingInterval){

        return response()->json([
            'success' => true,
            'message' => 'Reading Interval',
            'data' => $userReadingInterval
        ], 200);

       }

       return response()->json([
        'success' => false,
        'message' => 'this Reading Interval is not found',
       ], 404);

    }


    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy($id)
    {
        $userReadingInterval = UserReadingInterval::find($id);

        if ($userReadingInterval){
            if($userReadingInterval->delete()){

                return response()->json([
                    'success' => true,
                    'message' => 'Reading Interval deleted successfully'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Bad request, this Reading Interval is not deleted'
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'this Reading Interval is not found'
        ], 404);
    }

}