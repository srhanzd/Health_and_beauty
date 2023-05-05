<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required|unique:users|min:3',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone_number' => 'required|unique:users|digits:10',
            'telephone_number' => 'required|unique:users|digits_between:7,10',
            'email' => 'required|email|unique:users',
            'Birthdate' => 'required|date',//|numeric',
            'Address' => 'required',
            'Gender' => 'required',
            // 'profile_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:500',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',

        ];
    }

    protected function prepareForValidation()
    {
        //SOME WORK BEFOR THE SRVICES WORK
        //here you should test if the user enter min:8 after bcrypt it will be larger then 8 and it will pass
//      $password=  bcrypt($this->only('password')['password']);
//        $this->replace([
//            'password' =>$password,
//        ]);

    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors());
        //$code = $this->returnCodeAccordingToInput($validator);
        //return $this->returnValidationError($code, $validator);

        //return  $this->returnError(000, $validator->errors());
//        $response = [
//            'status' => 'failure',
//            'status_code' => 400,
//            'message' => 'Bad Request',
//            'errors' => $validator->errors(),
//        ];
       // $code = $this->returnCodeAccordingToInput($validator);

        throw new HttpResponseException($this->returnError(000,$validator->errors()));//$this->returnValidationError($code, $validator));
    }
}
