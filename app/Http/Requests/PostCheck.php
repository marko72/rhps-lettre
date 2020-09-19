<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCheck extends FormRequest
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
        if(!'btnUpdate'){
        return [
            "title"=>"required|max:250|string",
            "content"=>"required|string|max:5000",
            "picture"=>"required|image|max:2048"
        ];
        }else{
            return [
                "title"=>"required|max:250|string",
                "content"=>"required|string|max:5000",
                "picture"=>"image|max:2048"
            ];
        }
    }

    public function messages()
    {
        return [
            'required' => ':attribute je obavezan/na!',
            'max'  => ':attribute ima više karaktera nego što je dozvoljeno!',
            'picture.max' => 'Slika ima više od 2MB!',
            'image' => 'Fajl koji ste postavili nije slika!',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Naslov',
            'content' => 'Sadržaj',
            'picture' => 'Slika'
        ];
    }
}
