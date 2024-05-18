<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryFormRequest extends FormRequest
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
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category',
        ];
    }

    public function messages(){
        return [
            'main_category_name.required' => 'メインカテゴリー名の入力は必須です。',
            'main_category_name.string' => '正しい文字列で入力ください。',
            'main_category_name.max' => '100字以内で入力ください。',
            'main_category_name.unique' => 'この名前はすでに登録されています。',
        ];
    }
}
