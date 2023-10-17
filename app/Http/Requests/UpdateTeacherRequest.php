<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateTeacherRequest extends FormRequest
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
            'teacher_image' => 'sometimes|image',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'dob' => 'required',
            'email' => 'sometimes|email',
            'date_start' => 'sometimes'
        ];
    }
}
