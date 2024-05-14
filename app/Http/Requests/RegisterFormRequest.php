<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'|'max:30',
            'under_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'|'max:30',
            'mail_address' => 'required'|'email'|'unique:users,mail_address'|'max:100',
            'sex' => 'required'|'in:男性,女性,その他',
            'birth_day' => 'required'|'date_format:Y-m-d'|'after:2000-01-01'|'before:today',
            'role' => 'required'|'in:講師（國語）,講師（数学）,教師（英語）,生徒',
            'password' => 'required'|'min:8'|'max:30'|'confirmed',
            'password_confirmation' => 'required'|'min:8'|'max:30'

        ];
    }


}
