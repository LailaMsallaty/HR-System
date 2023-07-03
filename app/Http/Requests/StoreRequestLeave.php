<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestLeave extends FormRequest
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
            'leaveType' => 'required',
            'From' => 'required',
            'To'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'leaveType.required' => trans('validation.required'),
            'From.required' => trans('validation.required'),
            'To.required' => trans('validation.required'),

        ];
    }
}
