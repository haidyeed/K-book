<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookRequest extends FormRequest
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
        return [
            'name' => 'required|unique:books|min:5|max:150',
            'author' => 'required|min:5|max:150',
            'number_of_pages' => 'required|integer|min:1|max:5000',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => 'Unprocessable Entity, validation failed','message'=>$validator->errors()], 422));
    }

}
