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
        /*登録ページ*/
        if ($this->route('/products/register')){
            return [
                'name' => 'required',
                'price' => 'required | numeric | min:0 | max:1000',
                'seasons' => 'required',
                'image' => 'required|image|mimes:jpeg,png',
                'description' => 'required | max:120'
            ];
        }else {
            /*詳細ページ*/
            return [
                'name' => 'required',
                'price' => 'required | numeric | min:0 | max:1000',
                'seasons' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png',
                'description' => 'required | max:120'
            ];
        }
        
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください'
        ];
    }
}
