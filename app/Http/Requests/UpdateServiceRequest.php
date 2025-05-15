<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id'    => 'exists:vehicles,id',
            'user_id'       => 'exists:users,id',
            'started_at'    => 'date',
            'finished_at'   => 'nullable|date|after_or_equal:started_at',
            'status_id'     => 'nullable|exists:service_statuses,id',
            'description'   => 'nullable|string|max:255',
        ];
    }
}
