<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaves extends FormRequest
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
        'List_leaves.*.Name_Leave_ar' => 'required|unique:leaves,Name->ar,'.$this->id,
        'List_leaves.*.Name_Leave_en' => 'required|unique:leaves,Name->en,'.$this->id,
        'List_leaves.*.days' => 'required',

    ];
    }

    public function messages()
    {
        return [
            'Name_Leave_ar.required' => trans('validation.required'),
            'Name_Leave_en.required' => trans('validation.required'),
            'Name_Leave_en.unique' => trans('validation.unique'),
            'Name_Leave_ar.unique' => trans('validation.unique'),
            'days.required' => trans('validation.required'),


        ];
    }
}
