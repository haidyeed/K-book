<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserReadingIntervalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $number_of_pages = Book::where('id',request()->book_id)->first()->number_of_pages;
        
        return [
            'user_id' => 'required|integer|min:1|exists:users,id',
            'book_id' => 'required|integer|min:1',
            'start_page' => 'required|integer|min:1|max:'.$number_of_pages,
            'end_page' => 'required|integer|min:'.request()->start_page.'|max:'.$number_of_pages,
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => 'Unprocessable Entity, validation failed','message'=>$validator->errors()], 422));
    }

}
