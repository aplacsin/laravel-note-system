<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'priority' => ['required',Rule::in(['1', '2','3','4','5'])],
        ];
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getPriority(): int
    {
        return $this->input('priority');
    }
}
