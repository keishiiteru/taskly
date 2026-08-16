<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRecurrenceRequest extends FormRequest
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
            'frequency' => [
                'required',
                'string',
                Rule::in(['daily', 'weekly', 'monthly', 'yearly']),
            ],
            'interval' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'days_of_week' => [
                'nullable',
                'array',
                Rule::requiredIf(fn () => $this->input('frequency') === 'weekly'),
            ],
            'days_of_week.*' => [
                'integer',
                'between:0,6', // 0 = Sunday .. 6 = Saturday
            ],
            'starts_at' => [
                'required',
                'date',
            ],
            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'days_of_week.required' => 'Please select at least one day of the week for a weekly recurrence.',
            'ends_at.after_or_equal' => 'The end date must be on or after the start date.',
        ];
    }

    protected function prepareForValidation(): void
    {

        if (! $this->has('interval')) {
            $this->merge(['interval' => 1]);
        }
    }

    public function validatedWithTaskId(): array
    {
        return array_merge($this->validated(), [
            'task_id' => $this->route('task')->id,
        ]);
    }
}
