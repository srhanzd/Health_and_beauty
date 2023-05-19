<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchRequest extends FormRequest
{
    use GeneralTrait;
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
     * @return array
     */
    public function rules()
    {
        return[
            'search_query' => 'required|min:3|max:255',
            'search_query.required' => 'Please enter a search query.',
            'search_query.min' => 'The search query should be at least 3 characters long.',
            'search_query.max' => 'The search query should not exceed 255 characters.',

        ];
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors());


        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }
    protected function prepareForValidation()
    {
        // Retrieve specific header values
        $search_query = $this->header('search_query');

        // Set the header values back to the request
        $this->merge([
            'search_query' => $search_query,

        ]);
    }
}
