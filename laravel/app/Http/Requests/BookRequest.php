<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required',
            'cover' => 'file|image|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'img_url' => '表紙',
            'author' => '著者',
            'isbn' => 'ISBN',
            'page' => 'ページ',
            'publisher' => '出版社',
            'published_at' => '出版年月',
            'description' => '詳細',
            'status' =>'状態',
            'rank' =>'評価',
            'read_at' =>'読了日',
        ];
    }
}
