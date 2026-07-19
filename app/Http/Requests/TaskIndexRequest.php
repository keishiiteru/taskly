<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'completed' => ['sometimes', 'boolean'],
            'search'    => ['sometimes', 'string', 'max:255'],
            'sort_by'   => ['sometimes', 'string', 'in:title,completed,created_at,updated_at'],
            'sort_dir'  => ['sometimes', 'string', 'in:asc,desc'],
            'per_page'  => ['sometimes', 'integer', 'min:1', 'max:100'],
            'page'      => ['sometimes', 'integer', 'min:1'],
        ];
    }
}
