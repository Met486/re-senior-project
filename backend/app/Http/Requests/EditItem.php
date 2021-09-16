<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class EditItem extends SellItem
{

    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Item::STATUS));


        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item){
            return $item['label'];
        }, Item::STATUS);

        $status_labels = implode(', ', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. 'のいずれかを指定してください。',
        ];
    }
}
