<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Address_ar' => 'required|unique:locations,Address->ar,'.$this->id,
            'Address_en' => 'required|unique:locations,Address->en,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'Address_ar.required' => trans('validation.required'),
            'Address_en.required' => trans('validation.required'),
            'Address_ar.unique' => trans('validation.unique'),
            'Address_en.unique' => trans('validation.unique'),

        ];
    }
}
