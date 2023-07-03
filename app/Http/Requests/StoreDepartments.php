<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartments extends FormRequest
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
            'List_Departments.*.Name_department_ar' => 'required|unique:departments,Name->ar,'.$this->id,
            'List_Departments.*.Name_department_en' => 'required|unique:departments,Name->en,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'Name_department_ar.required' => trans('validation.required'),
            'Name_department_en.required' => trans('validation.required'),
            'Name_department_en.unique' => trans('validation.unique'),
            'Name_department_ar.unique' => trans('validation.unique'),

        ];
    }
}
