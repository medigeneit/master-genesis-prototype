<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
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
        // return [
        //     'starting_date' => ['required', BookingStoreRequest::not_in_blocked_dates( )],
        //     'starting_time' => ['required'],
        //     'duration_hour' => ['required'],
        //     'duration_minute' => ['required'],

        //     'topic_id' => ['nullable', 'integer'],
        //     'department_id' => ['required', 'integer'],
        //     'bookable_type' => ['nullable', 'string'],
        //     'bookable_id' => ['nullable', 'integer'],
        //     'batch_id' => ['required', 'integer'],
        //     'mentor_id.*' => ['exists:mentors,id', 'integer', BookingStoreRequest::mentor_availablity_rule($this)],
        //     'room_id.*' => ['exists:rooms,id', 'integer', BookingStoreRequest::room_availablity_rule($this)],
        // ];

        return [
            'starting_date' => ['required', BookingStoreRequest::not_in_blocked_dates()],
            'starting_time' => ['required'],
            'duration_hour' => ['required'],
            'duration_minute' => ['required'],
            'department_id' => ['required', 'integer'],
            'mentor_id.*' => ['exists:mentors,id', 'integer', BookingStoreRequest::mentor_availablity_rule($this)],
            'room_id.*' => ['exists:rooms,id', 'integer', BookingStoreRequest::room_availablity_rule($this)],
        ] + (BookingStoreRequest::booking_type_rules($this) ?? []);

    }
}
