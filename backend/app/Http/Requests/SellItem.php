<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true; // TODO 追々ログイン状態であることを確認する
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:20',
            'category' => 'required',
            // 'sub_category' => 'required',
            'isbn_13' => 'required|max:13|min:13',
            'files.*.photo' => 'image|mimes:jpeg,bmp,png',
            //
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'category' => 'カテゴリ',
            'sub_category' => 'サブカテゴリ',
            'isbn_13' => 'ISBN-13',
        ];
    }
}
