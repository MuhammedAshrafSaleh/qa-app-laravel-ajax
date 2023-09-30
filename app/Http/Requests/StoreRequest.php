<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'question' => ['required','string', 'max:1000', 'min:3'],
            'answer' => ['nullable','string'],
            'important_status' => ['nullable','integer', 'between:0,1'],
            'answer_status' => ['nullable','integer', 'between:0,1'],
            'archive_status' => ['nullable','integer', 'between:0,1'],
            'tag_id' => ['nullable','integer', 'exists:tags,id'],
        ];
    }
}
