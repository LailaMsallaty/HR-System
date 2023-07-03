<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalary extends FormRequest
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
            'location_id'=>'required',
            'department_id'=>'required',
            'employee_id'=>'required',
            'taxes'=>'required|lte:100',
            'insurance'=>'required|lte:100',
            'Bonus'=>'lte:100',
            'From'=>'required',
            'To'=>'required',

        ];
    }
     public function messages()
    {
        return [
        'location_id.required'=>trans('validation.required'),
        'department_id.required'=>trans('validation.required'),
        'employee_id.required'=>trans('validation.required'),
        'taxes.required'=>trans('validation.required'),
        'From.required'=>trans('validation.required'),
        'To.required'=>trans('validation.required'),
        'insurance.required'=>trans('validation.required'),
        'taxes.lte:100' => trans('validation.lte.numeric'),
        'insurance.lte:100' => trans('validation.lte.numeric'),
        'Bonus.lte:100' => trans('validation.lte.numeric'),
        ];
    }
}
