<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends FormRequest
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
            'username' => "required|alpha_dash|unique:users,username|max:50",
            'email'   => "email|nullable|unique:users,email|max:100",
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6',
            'role_id' => "required",
            'first_name' => "required|max:50",
            'last_name' => "required|max:50",
        ];
    }
}
