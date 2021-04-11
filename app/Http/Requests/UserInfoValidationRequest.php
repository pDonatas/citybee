<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoValidationRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'birth_date' => 'required|date'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'surname.required' => 'A surname is required',
            'email.required' => 'A email is required',
            'phone.required' => 'A phone is required',
            'birth_date.required' => 'A birthday is required',
        ];
    }
}
