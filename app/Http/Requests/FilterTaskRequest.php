<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterTaskRequest extends FormRequest
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
            'title' => ['nullable','alpha_num'],
            'priority'   => ['nullable','integer','between:1,5'],            
            'sort' => [Rule::in(['priority', 'created_at'])],
            'method_sort' => [Rule::in(['asc', 'desc'])],
        ];
    }
}
