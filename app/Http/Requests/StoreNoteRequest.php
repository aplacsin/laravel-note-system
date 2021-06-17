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
            'title' => ['required', 'max:100'],
            'content' => ['required', 'max:500'],
            'image[]' => ['nullable', 'mimes:jpg,jpeg,bmp,png', 'max:10000'],
            'image.*' => ['nullable', 'mimes:jpg,jpeg,bmp,png', 'max:10000'],
            'note_id' => ['nullable']
        ];
    }
}
