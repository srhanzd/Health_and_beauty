<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'token'=>'required',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors());


        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }
}
