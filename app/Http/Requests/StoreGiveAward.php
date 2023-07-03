<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGiveAward extends FormRequest
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
            'awardType'=>'required',
            'location'=>'required',
            'employee'=>'required',
            'Cash_Prize'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'awardType.required' => trans('validation.required'),
            'location.required' => trans('validation.required'),
            'employee.required' => trans('validation.required'),
            'Cash_Prize.required' => trans('validation.required'),

        ];
    }
}
