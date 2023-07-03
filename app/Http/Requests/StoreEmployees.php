<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployees extends FormRequest
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
            'FName'=>'required|alpha|max:20',
            'LName'=>'required|alpha|max:20',
            'Email'=>'required|email|unique:employees,email,'.$this->id,
            'Number'=>'integer|required|unique:employees,Number,'.$this->id,
            'Gender'=>'required',
            'HireDate'=>'required',
            'Address'=>'required|alpha_num',
            'Trainee'=>'required',
            'YearsOfExp'=>'required',
            'employee_department'=>'required',
            'position_id'=>'required',
            'location_id'=>'required',
            'Skills'=>'required',
            'Degree'=>'required',
            'BirthDate'=>'before_or_equal:2000-12-31',
            'Code'=>'required|unique:employees,Code,'.$this->id,



        ];
    }

    public function messages()
    {
        return [
            'FName.required'=>trans('validation.required'),
            'LName.required'=>trans('validation.required'),
            'FName.alpha'=>trans('validation.alpha'),
            'LName.alpha'=>trans('validation.alpha'),
            'FName.max:20'=>trans('validation.max.string'),
            'LName.max:20'=>trans('validation.max.string'),
            'ُEmail.required'=>trans('validation.required'),
            'ُEmail.unique'=>trans('validation.unique'),
            'ُEmail.email'=>trans('validation.email'),
            'Gender.required'=>trans('validation.required'),
            'HireDate.required'=>trans('validation.required'),
            'Address.required'=>trans('validation.required'),
            'Address.alpha_num'=>trans('validation.alpha_num'),
            'Trainee.required'=>trans('validation.required'),
            'Years_Of_Experience.required'=>trans('validation.required'),
            'employee_department.required'=>trans('validation.required'),
            'position_id.required'=>trans('validation.required'),
            'location_id.required'=>trans('validation.required'),
            'Skills.required'=>trans('validation.required'),
            'Degree.required'=>trans('validation.required'),
            'Code.required'=>trans('validation.required'),
            'ُCode.unique'=>trans('validation.unique'),
            'BirthDate.before_or_equal'=>trans('validation.before_or_equal'),
            'Number.integer'=>trans('validation.integer'),



        ];
    }
}
