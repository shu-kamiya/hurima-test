<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'post_code' => ['required', 'regex:/^\d{3}-?\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'post_code.required' => '郵便番号は必須です。',
            'post_code.regex' => '郵便番号はハイフンを含む7桁で入力してください（例: 123-4567）。',
            'address.required' => '住所は必須です。',
        ];
    }
}
