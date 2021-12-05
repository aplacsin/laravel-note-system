<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:150'],
            'content' => ['required'],
            'image' => ['nullable'],
            'image.*' => ['mimes:jpeg,png,jpg,gif,svg'],
            'file' => ['nullable'],
            'file.*' => ['mimes:txt,doc,docx,pdf'],
        ];
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getText(): string
    {
        return $this->input('content');
    }
}
