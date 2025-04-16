<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'vehicle_id'    => 'required|exists:vehicles,id',
            'user_id'       => 'required|exists:users,id',
            'started_at'    => 'required|date',
            'finished_at'   => 'nullable|date|after:started_at',
        ];
    }
}
