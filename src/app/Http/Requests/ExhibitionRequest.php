<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
            'condition' => ['required', 'in:良好,目立った傷や汚れなし,やや傷や汚れあり,状態が悪い'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像を選択してください。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像は jpeg または png 形式でアップロードしてください。',
            'category_ids.required' => 'カテゴリを1つ以上選択してください。',
            'condition.required' => '商品の状態を選択してください。',
            'name.required' => '商品名を入力してください。',
            'name.max' => '商品名は255文字以内で入力してください。',
            'description.required' => '商品の説明を入力してください。',
            'description.max' => '商品の説明は255文字以内で入力してください。',
            'price.required' => '販売価格を入力してください。',
            'price.numeric' => '販売価格は数値で入力してください。',
            'price.min' => '販売価格は0円以上で入力してください。',
        ];
    }
}
