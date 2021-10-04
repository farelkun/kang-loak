<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name'              => 'required',
            'phone'             => 'required',
            'email'             => 'required|email|unique:users',
            'username'          => 'required|unique:users',
            'password'          => 'required',
            'confirm_password'  => 'required|same:password'
        ];
    }
}
