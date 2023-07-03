<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvents extends FormRequest
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
        'List_Events.*.Name_Event_ar' => 'required|unique:events,title->ar,'.$this->id,
        'List_Events.*.Name_Event_en' => 'required|unique:events,title->en,'.$this->id,
        'List_Events.*.From' => 'required',
        'List_Events.*.To' => 'required',

    ];
    }

    public function messages()
    {
        return [
            'Name_Event_ar.required' => trans('validation.required'),
            'Name_Event_en.required' => trans('validation.required'),
            'Name_Event_en.unique' => trans('validation.unique'),
            'Name_Event_ar.unique' => trans('validation.unique'),
            'From.required' => trans('validation.required'),
            'To.required' => trans('validation.required'),


        ];
    }
}
