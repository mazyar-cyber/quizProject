<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => ['required', 'numeric', 'unique:users'],
            'is_Teacher' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است',
            'password.required' => 'وارد کردن رمز عبور الزامی است',
            'email.required' => 'وارد کردن ایمیل برای کاربر الزامی است',
            'password.string' => 'رمز عبور باید شامل حروف باشد',
            'password.min' => 'رمز عبور باید حداقل شامل 8 حرف باشد',
            'password.confirmed' => 'رمز عبور را با تکرارش برابر نبود',
            'name.string' => 'نام کاربر باید شما حروف باشد',
            'email.string' => 'ایمیل باید شما حروف باشد',
            'name.string' => 'نام کاربر حداکثر 225 کلمه میتواند باشد',
            'email.string' => 'ایمیل  حداکثر 225 کلمه میتواند باشد',
            'phoneNumber.unique' => 'این شماره تلفن قبل ثبت شده است'
        ];
    }
}
