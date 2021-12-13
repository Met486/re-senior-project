<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishItemRequest extends FormRequest
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
            'title' => 'required|max:200',
            'category' => 'required',
            'isbn_13' => 'required|max:20|min:13',
            'scratches' => 'required',
            'cover' => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'category' => 'カテゴリ',
            'sub_category' => 'サブカテゴリ',
            'isbn_13' => 'ISBN-13',
            // 'comment' => 'コメント',
        ];
    }
}
