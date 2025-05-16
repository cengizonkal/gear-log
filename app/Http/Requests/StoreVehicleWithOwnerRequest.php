<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleWithOwnerRequest extends FormRequest
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
            
            'vehicle.license_plate' => 'required|string|min:5|max:10',
            'vehicle.mileage' => 'nullable|integer',
            'vehicle.fuel_type_id' => 'required|exists:fuel_types,id',
            'vehicle.vin' => 'nullable|string|max:20|unique:vehicles,vin',
            'vehicle.vehicle_model_id' => 'required|exists:vehicle_models,id',
            'vehicle.year' => 'integer',
            'vehicle.engine_capacity' => 'integer',
            'vehicle.weight' => 'integer',
            'owner.name' => 'required|string|max:255',
            'owner.phone' => 'required|string|max:255',
            'owner.email' => 'nullable|email|max:255|unique:users,email',
        ];
    }
}
