<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCheck extends FormRequest
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
        if('edit'){
            return [
                'email'=>[
                    'required',
                    'email'
                ],
                'name' => [
                    'required',
                    'regex:/^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/'
                ],
                'surname' => [
                    'required',
                    'regex:/^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/'
                ],
                'passwd' => 'required'
            ];
        }else{
            return [
                'email'=>[
                    'required',
                    'email',
                    'unique:users,email'
                ],
                'name' => [
                    'required',
                    'regex:/^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/'
                ],
                'surname' => [
                    'required',
                    'regex:/^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/'
                ],
                'passwd' => 'required'
            ];
        }

    }

    public function messages()
    {
        return [
            'required'=>':attribute je obavezno polje!',
            'regex'=>':attribute nije u skladu sa pravilima',
            'unique' => "Korisnik sa ti e-mail om već postoji"
        ];
    }

    public function attributes()
    {
        return [
            'email'=>"E-mail",
            'passwd'=>'Lozinka',
            'name' => 'Ime',
            'surnmae' => 'Prezime'
        ];
    }
}
