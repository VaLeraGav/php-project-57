<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest  extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:tasks,name|max:255',
            'status_id' => 'required',
            'assigned_to_id' => 'required',
            'description' => 'max:255',
            'labels' => '',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Это обязательное поле',
            'name.max' => 'Максимальное количество знаков: 255',
            'name.unique' => 'Задача с таким именем уже существует',
            'status_id.required' => 'Это обязательное поле',
            'assigned_to_id.required' => 'Это обязательное поле',
            'description.max' => 'Максимальное количество знаков: 255',
        ];
    }
}
