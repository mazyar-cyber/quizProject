<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class TestUpdateRequest extends FormRequest
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
            'name' => ['required', Rule::unique('tests', 'name')->ignore($this->test)],
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام آزمون را وارد کنید',
            'name.unique' => 'نام آزمون نمیتواند تکراری باشد',
            'status.required' => 'وضعیت آزمون را مشخص کنید',
        ];
    }
}
