<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginCheck extends FormRequest
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
            'email'=>[
                'required',
                'email'
            ],
            'passwd'=>[
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
          'required'=>':attribute je obavezno polje!',
          'regex'=>':attribute nije u skladu sa pravilima'
        ];
    }

    public function attributes()
    {
        return [
            'email'=>"E-mail",
            'passwd'=>'Lozinka'
        ];
    }
}
