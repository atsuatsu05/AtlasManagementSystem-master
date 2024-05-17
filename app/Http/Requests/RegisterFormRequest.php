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
    public function getValidatorInstance(){
        $date = $this->all();
        $date['birthday'] = $this->input('old_year').'-'.$this->input('old_month').'-'.$this->input('old_day');

        $this->getInputSource()->replace($date);

        return parent::getValidatorInstance();
    }

    public function rules()
    {
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'mail_address' => 'required|email|unique:users,mail_address|max:100',
            'sex' => 'required|in:1,2,3',
            'birthday' => 'required|date|after:1999-12-31|before:today',
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|min:8|max:30|confirmed',

        ];
    }

    public function messages()
    {
        return [
            'over_name.required' => '入力は必須です。',
            'over_name.max' => '10字以内で入力ください。',

            'under_name.required' => '入力は必須です。',
            'under_name.max' => '10字以内で入力ください。',

            'over_name_kana.required' => '入力は必須です。',
            'over_name_kana.regex' => 'カタカナで入力ください。',

            'under_name_kana.required' => '入力は必須です。',
            'under_name_kana.regex' => 'カタカナで入力ください。',

            'mail_address.required' => '入力は必須です。',
            'mail_address.email' => 'メール形式で入力ください。',
            'mail_address.unique' => 'すでに登録されているメールアドレスです。',
            'mail_address.max' => '100字以内で入力ください。',

            'sex.required' => '入力は必須です。',

            'birthday.required' => '入力は必須です。',
            'birthday.date' => '正しい日付で選択ください。',
            'birthday.after' => '2000年1月1日以降の日付で選択ください。',
            'birthday.before' => '未来日は指定できません。',

            'role.required' => '入力は必須です。',

            'password.required' => '入力は必須です。',
            'password.min' => '8文字以上30文字以内で入力ください',
            'password.max' => '8文字以上30文字以内で入力ください',
            'password.confirmed' => '確認用パスワードと一致していません。'

            ];
    }


}
