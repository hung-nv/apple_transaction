<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IphoneInformationUpdate extends FormRequest
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
            'internal_name' => 'max:255|required|unique:iphone_informations,internal_name,'.$this->segment(3),
            'identify' => 'max:255,required|unique:iphone_informations,identify,'.$this->segment(3),
            'models' => ['required', 'regex:/^(\w|\,|\s)+$/']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'models.regex' => 'Models không đúng định dạng, vui lòng chỉ nhập ký tự a-z, A-Z, 0-9, space và dấu ","'
        ];
    }
}
