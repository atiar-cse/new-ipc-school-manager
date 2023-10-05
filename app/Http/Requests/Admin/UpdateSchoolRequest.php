<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateSchoolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
    public function rules(): array
    {
        return [
            'school_name' => 'required',
            'category_id' => 'required',
            'username' => 'required|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'mailingAddress' => 'required',
            'mailingCity' => 'required',
            'mailingZip' => 'required',
            'mailingState' => 'required',
            'mailingCountry' => 'required',
        ];
    }
}
