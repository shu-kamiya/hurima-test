<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:20'],
            'image' => ['nullable', 'image',  'mimes:jpeg,png'],
            'post_code' => ['required', 'regex:/^\d{3}-?\d{4}$/'],
            'address' => ['required', 'string'],
            'building' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.max' => 'ユーザー名は20文字以内で入力してください',
            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => 'プロフィール画像はjpegまたはpng形式でアップロードしてください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex' => '郵便番号は123-4567の形式で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
