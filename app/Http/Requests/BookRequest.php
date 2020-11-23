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
            'title' => 'required|max:100',
            // 'cover' => '',
            // 'author' => '',
            'isbn' => 'numeric',
            'description' => 'max:500',
            // 'status' =>'',
            // 'rank' =>'',
            // 'read_at' =>'',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'cover' => '表紙',
            'author' => '著者',
            'isbn' => 'ISBN',
            'description' => '詳細',
            'status' =>'状態',
            'rank' =>'評価',
            'read_at' =>'読了日',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }

}
