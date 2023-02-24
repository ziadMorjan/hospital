<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string|min:3',
            'location'=>'required|string|min:3',
            'cover'=>'nullable|image|mimes:png,jpg',
            'describtin'=>'nullable|string|min:3',
            'is_active'=>'in:no|string'
        ];
    }
}
