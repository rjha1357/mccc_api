<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredUsers extends FormRequest
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
            'Name'      => 'required|alpha|min:2|max:50',
            'Email'     => 'required|email|max:50',
            'Phone'     => 'required|min:8|max:15',
            'Password'  => 'required|min:8|max:20',
            'Dob'       =>'required',
            'gender'    =>'required',
            'slecState'     =>'required',
            'slecCity'      =>'required',
            
        ];
    }

    public function messages()
    {
        return [
            'Name.alpha' => 'Please enter only alphabets.',
            'Name.required' => 'name field is required.',
            'Name.max:50' => 'name only accept 50 characters.',
            'Email.required' => 'Email field  is required.',
            'Email.email' => 'Please enter a valid email address.',
            'Password.required' => 'Password field  is required.',
            'Phone.required' => 'Phone field is required.',
            'Dob' => 'Date of birth field is required.',
            'country' => 'Country field is required.',
            'slecState' => 'State field is required.',
            'slecCity' => 'City code field is required.',
            'gender' => 'Gender field is required.',
            ];
    }
}
