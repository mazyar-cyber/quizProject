<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsSendRequest extends FormRequest
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
            'phoneNumber' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'phoneNumber.required' => 'لطفا شماره تلفنی را در که هنگام ثبت نام وارد کردید را بنویسید',
            'phoneNumber.numeric' => 'شماره  تلفن را به صورت عدد وارد کنید',
        ];
    }
}
