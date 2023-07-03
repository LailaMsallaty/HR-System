<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePunishment extends FormRequest
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
            'List_Punishments.*.Name_Punishment_ar' => 'required|unique:punishments,Name->ar,'.$this->id,
            'List_Punishments.*.Name_Punishment_en' => 'required|unique:punishments,Name->en,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'Name_Punishment_ar.required' => trans('validation.required'),
            'Name_Punishment_en.required' => trans('validation.required'),
            'Name_Punishment_en.unique' => trans('validation.unique'),
            'Name_Punishment_ar.unique' => trans('validation.unique'),

        ];
    }
}
