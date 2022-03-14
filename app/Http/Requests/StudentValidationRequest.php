<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentValidationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => "required|max:255",
            'last_name' => "required|max:255",
            'password' => "required|min:6|same:password_confirm",
//            'email' => ['required', 'email', 'unique:users,email']
            'email' => ['required', 'email', 'unique:users,email' . $this->id ?: null]
        ];
    }
}
