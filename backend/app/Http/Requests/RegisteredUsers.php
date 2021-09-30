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
            'name'                  => 'required|min:2|max:28',
            // 'name.*'                  => 'regex:/^[a-zA-Z]+$|^[a-zA-Z]+ [a-zA-Z]+$|^[a-zA-Z]+ [a-zA-Z]+ [a-zA-Z]+$|^[a-zA-Z]+ [a-zA-Z]+ [a-zA-Z]+ [a-zA-Z]+$/',
            'email'                 => 'required|email|max:28|unique:registeredusers',
            'phone'                 => 'required|numeric|digits:10|unique:registeredusers',
            'password'              => 'required|min:6|max:8',
            'confirm_password'      => 'required|min:6|max:8|same:password',
            'dob'                   => 'required|max:10|regex:/^[0-9 -]+$/',
            'gender'                => 'required',
            'select_state'          => 'required',
            'select_city'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.regex'                    => 'Name field is invalid.',
            'name.required'                 => 'Name field is required.',
            // 'name.max:28'                   => 'Name only accept 28 characters.',
            'email.required'                => 'Email field  is required.',
            'email.email'                   => 'Please enter a valid email address.',
            'email.max:28'                  => 'Email only accept 28 characters.',
            'email.unique'                  => 'A user with this email address already exists.',
            'password.required'             => 'Password field  is required.',
            // 'password.min'                  => 'Password cannot be less then 6 characters.',
            'confirm_password.required'     => 'Confirm-Password field is required.',
            // 'password.confirmed'            => 'Password and Confirm-password does not match',
            'phone.required'                => 'Phone field is required.',
            'phone.unique'                  => 'A user with this Mobile Number already exists.',
            'phone.numeric'                 => 'Please enter only numbers.',
            'phone.digits'                 => 'Please enter only 10 digits numbers.',
            'dob'                           => 'Date of birth field is required.',
            'select_state'                  => 'State field is required.',
            'select_city'                   => 'City code field is required.',
            'gender'                        => 'Gender field is required.'
            ];
    }
}
