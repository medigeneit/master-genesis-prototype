<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'started_at' => ['required'],
            'ending_at' => ['nullable'],
            'topic_id' => ['nullable', 'integer'],
            'department_id' => ['required', 'integer'],
            'bookable_type' => ['nullable', 'string'],
            'bookable_id' => ['nullable', 'integer'],
            'batch_id' => ['required', 'integer'],
        ];
    }
}
