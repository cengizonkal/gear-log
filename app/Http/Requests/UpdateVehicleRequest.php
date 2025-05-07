<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'license_plate' => 'string|max:10',
            'mileage' => 'integer',
            'owner_id' => 'exists:owners,id',
            'fuel_type_id' => 'exists:fuel_types,id',
            'vin' => 'string|max:20|unique:vehicles,vin,' . $this->vehicle->id,
            'vehicle_model_id' => 'exists:vehicle_models,id',
            'year' => 'integer',
            'engine_capacity' => 'integer',
            'weight' => 'integer',
        ];
    }
}
