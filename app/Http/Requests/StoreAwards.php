<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAwards extends FormRequest
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
        'List_awards.*.Name_Award_ar' => 'required|unique:awards,Name->ar,'.$this->id,
        'List_awards.*.Name_Award_en' => 'required|unique:awards,Name->en,'.$this->id,

    ];
    }

    public function messages()
    {
        return [
            'Name_Award_ar.required' => trans('validation.required'),
            'Name_Award_en.required' => trans('validation.required'),
            'Name_Award_en.unique' => trans('validation.unique'),
            'Name_Award_ar.unique' => trans('validation.unique'),


        ];
    }
}
