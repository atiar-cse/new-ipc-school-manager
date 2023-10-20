<?php

namespace App\Http\Requests\SchoolManager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateFamilyRequest extends FormRequest
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
            'title' => 'required|max:128',
            'father_name' => 'max:60',
            'mother_name' => 'max:60',
            'street' => 'max:255',
            'postcode' => 'max:20',
            'city'  => 'max:50',
            'state' => 'max:50',
            'country'   => 'max:50',
            'phone_h'   => 'max:20',
            'phone_o'   => 'max:20',
            'mobile_m'  => 'max:20',
            'mobile_f'  => 'max:20',
            'email_m'   => 'nullable|email',
            'email_f'   => 'nullable|email',
            'username'  => 'required|alpha_dash|unique:users,username,' . $this->family->user_id,
            'email'     => 'email|nullable|unique:users,email,' . $this->family->user_id,
            'password'  => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6'
        ];
    }
}
