<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required'],
            'description'=> ['required'],
            'province'=> ['required', Rule::in(["Akkar", "Baalbeck", "Beirut", "Bekaa", "Mount Lebanon", "North Lebanon", "Nabatiyeh", "South Lebanon"])],
            'city'=> ['required'],
            'street'=> ['required'],
            'latitude'=> ['required'],
            'longitude'=> ['required'],
            'type'=> ['required', Rule::in(["apartments", "flat", "house", "villa"])],
            'parking'=> ['required'],
            'bedrooms'=> ['required'],
            'bathrooms'=> ['required'],
            'area'=> ['required'],
            'built_in'=> ['required'],
            'buy_or_rent'=> ['required', Rule::in(["buy", "rent"])],
        ];
    }
}
