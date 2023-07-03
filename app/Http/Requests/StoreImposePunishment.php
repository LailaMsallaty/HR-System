<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImposePunishment extends FormRequest
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
            'punishment_id'=>'required',
            'location_id'=>'required',
            'department_id'=>'required',
            'employee'=>'required',
            'statement'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'punishment_id.required' => trans('validation.required'),
            'employee.required' => trans('validation.required'),
            'location_id.required' => trans('validation.required'),
            'department_id.required' => trans('validation.required'),
            'statement.required' => trans('validation.required'),

        ];
    }
}
