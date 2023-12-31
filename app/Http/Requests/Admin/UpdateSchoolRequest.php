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
        ], 422));
    }
    public function rules(): array
    {

        return [
            //users
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $this->school->user_id,
            'email' => 'required|email|unique:users,email,' . $this->school->user_id,
            'role_id' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            //schools
            'school_name' => 'required|unique:schools,name,' . $this->school->id,
            'position' => 'required',
            'group_id' => 'required',
            //address
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'country' => 'required',
            //mail address
            'mailingAddress' => 'required',
            'mailingCity' => 'required',
            'mailingZip' => 'required',
            'mailingState' => 'required',
            'mailingCountry' => 'required',
        ];
    }
}
