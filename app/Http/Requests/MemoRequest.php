<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemoRequest extends FormRequest
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
            'memo' => 'required|max:1000',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            // 正規表現は半角スペース・スラッシュがないことの確認
        ];
    }

    public function attributes()
    {
        return [
            'memo' => 'メモ',
            'tags' => 'タグ',
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
