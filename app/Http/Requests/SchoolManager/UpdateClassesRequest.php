<?php

namespace App\Http\Requests\SchoolManager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateClassesRequest extends FormRequest
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
            'name' => 'required',
            'teachers.*' => 'required',
            'ipc_level' => 'required',
        ];
    }
}
