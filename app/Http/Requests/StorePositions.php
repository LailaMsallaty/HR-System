<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePositions extends FormRequest
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
             'Role_ar' => 'required|unique:positions,Role->ar,'.$this->id,
             'Role_en' => 'required|unique:positions,Role->en,'.$this->id,
             'Requirements' => 'max:255',
             'Salary' => 'required|gte:50000',
             'FT_PT'=> 'required',
             'position_department'=>'required',


        ];
    }
    public function messages()
    {
        return [
            'Role_ar.required' => trans('validation.required'),
            'Role_en.required' => trans('validation.required'),
            'Role_en.unique' => trans('validation.unique'),
            'Role_ar.unique' => trans('validation.unique'),
            'Requirements.max' => trans('validation.max.string'),
            'Salary.gte:50000' => trans('validation.gte.numeric'),
            'FT_PT.required' => trans('validation.required'),
            'position_department.required'=>trans('validation.required'),


        ];
    }
}
