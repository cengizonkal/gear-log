<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vehicle_id'    => 'exists:vehicles,id',
            'user_id'       => 'exists:users,id',
            'started_at'    => 'date',
            'finished_at'   => 'nullable|date|after_or_equal:started_at',
            'status_id'     => 'exists:service_statuses,id',
            'description'   => 'nullable|string|max:255',
        ];
    }
}
