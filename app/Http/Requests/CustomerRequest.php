<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|min:4',
            'email' => "required|email|max:255|Rule::unique('customer')",
            'dbo' => 'required|date',
        ];
    }
    public function messages(){
        $message =[
            'name.required' => 'This field must be required can not be blank',
            'name.min' => 'Need at least 4 character on filed',
            'email.required' => 'It can not be blank',
            'email.email' => 'It must compare with E-mail format',
            'email.max' => 'Max length of string in field is 25',
            'email.unique' => 'One customer one email',
            'dbo.required' => 'Can not be blank',
            'dbo.date' => 'Date format is failed',
        ];
        return $message;
    }
}
