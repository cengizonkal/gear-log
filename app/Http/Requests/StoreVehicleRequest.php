<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
        'license_plate' => 'required|string|min:5|max:10',
        'mileage' => 'required|integer',
        'owner_id' => 'required|exists:owners,id',
        'fuel_type_id' => 'required|exists:fuel_types,id',
        'vin' => 'required|string|max:20|unique:vehicles,vin',
        'vehicle_model_id' => 'required|exists:vehicle_models,id',
        'year' => 'integer',
        'engine_capacity' => 'integer',
        'weight' => 'integer',
        ];
    }
}
