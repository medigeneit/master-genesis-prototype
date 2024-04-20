<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentUpdateRequest extends FormRequest
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
            'topic_id' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'material_id' => ['required', 'integer'],
            'batch_id' => ['nullable', 'integer'],
            'session_id' => ['required', 'integer'],
            'clinical_id' => ['nullable', 'integer'],
        ];
    }
}
