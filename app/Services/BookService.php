<?php

namespace App\Services;

use App\Models\Book;
use App\Models\UserReadingInterval;

class BookService
{
    public function topRecommendedBooks()
    {
        // Fetch all user reading intervals and group them by book ID
        $allIntervals = UserReadingInterval::select('start_page','end_page','book_id', )->orderBy('start_page')->get()->groupBy('book_id')->toArray();
        if(!$allIntervals)
        return response()->json(['error' => "not found" ,'message'=>"no interval is found"], 400);

        // Initialize an array to store merged intervals
        $mergedIntervals = [];
    
        foreach ($allIntervals as $interval) {

            if(count($interval)<=1){
                // If there's only one interval, no need to merge
                $intervalData = [
                    'book_id' => $interval[0]['book_id'],
                    'start_page' => $interval[0]['start_page'],
                    'end_page' => $interval[0]['end_page'],
                    'total_pages' => $interval[0]['end_page'] - $interval[0]['start_page'] +1
                ];
    
                array_push($mergedIntervals, $intervalData);
            }
            else{
                // Merge overlapping intervals
                $minStart = $interval[0]['start_page'];
                $maxEnd = $interval[0]['end_page'];
    
                for($i=1; $i<count($interval); $i++){

                    if($interval[$i]['start_page'] <= $maxEnd) {
                        // if Overlapping interval found, update max_end
                        $maxEnd = max($interval[$i]['end_page'], $maxEnd);
                    }else{
                        // Non-overlapping interval, add the merged interval
                        $intervalData = [
                            'book_id' => $interval[0]['book_id'],
                            'start_page' => $minStart,
                            'end_page' => $maxEnd,
                            'total_pages' => $maxEnd - $minStart +1
                        ];

                        array_push($mergedIntervals, $intervalData);
    
                        // Reset for the next interval
                        $minStart= $interval[$i]['start_page'];
                        $maxEnd = $interval[$i]['end_page'];
                    }
    
                }
                
                // Add the last merged interval
                $intervalData = [
                    'book_id' => $interval[0]['book_id'],
                    'start_page' => $minStart,
                    'end_page' => $maxEnd,
                    'total_pages' => $maxEnd - $minStart +1
                ];
                array_push($mergedIntervals, $intervalData);
        
            }
        }
    
        $sortedMergedIntervalsCollection = collect($mergedIntervals)->groupBy('book_id')->map(function ($item) {
            return $item->sum('total_pages');
        })->sortDesc()->take(5);
    
        $recommendedBooks = [];
        foreach ($sortedMergedIntervalsCollection as $bookId => $totalPages) {
            $bookDetails = Book::find($bookId);
            $recommendedBooks[] = [
                'book_id' => $bookId,
                'book_name' => $bookDetails->name,
                'num_of_read_pages' => $totalPages,
            ];
        }
    
        return response()->json($recommendedBooks,200);

    }


}
