<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCity extends FormRequest
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
            'List_Cities.*.Name_ar' => 'required|unique:cities,Name->ar,'.$this->id,
            'List_Cities.*.Name_en' => 'required|unique:cities,Name->en,'.$this->id,
            'List_Cities.*.country' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'country.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
            'Name_ar.unique' => trans('validation.unique'),

        ];
    }
}
