<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->route('/products/register')){
            return [
                'name' => 'required',
                'price' => 'required | numeric | min:0 | max:1000',
                'seasons' => 'required',
                'image' => 'required|image|mimes:jpeg,png',
                'description' => 'required | max:120'
            ];
        }else {
            return [
                'name' => 'required',
                'price' => 'required | numeric | min:0 | max:1000',
                'seasons' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png',
                'description' => 'required | max:120'
            ];
        }
        
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $price = $this->input('price');
            $description = $this->input('description');

            if ($price === null || $price === '') {
                $validator->errors()->add('price', '値段を入力してください');
                $validator->errors()->add('price', '数値で入力してください');
                $validator->errors()->add('price', '0~1000円以内で入力してください');
            } elseif (!is_numeric($price)) {
                $validator->errors()->add('price', '数値で入力してください');
            } elseif ($price < 0 || $price > 1000) {
                $validator->errors()->add('price', '0~1000円以内で入力してください');
            }

            if (empty($description)) {
                $validator->errors()->add('description', '商品説明を入力してください');
                $validator->errors()->add('description', '商品説明を入力してください');
            } elseif (mb_strlen($description) > 120) {
                $validator->errors()->add('description', '120文字以内で入力してください');
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0~1000円以内で入力してください',
            'price.max' => '0~1000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください'
        ];
    }
}
