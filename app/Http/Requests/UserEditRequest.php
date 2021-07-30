<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
//            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'phoneNumber' => ['required','numeric', Rule::unique('users')->ignore($this->user)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است',
            'email.unique' => 'ایمیل باید یکتا باشد',
            'password.required' => 'وارد کردن رمز عبور الزامی است',
            'email.required' => 'وارد کردن ایمیل برای کاربر الزامی است',
            'password.string' => 'رمز عبور باید شامل حروف باشد',
            'password.min' => 'رمز عبور باید حداقل شامل 8 حرف باشد',
            'password.confirmed' => 'به تایید رمز عبور دقت کنید',
            'name.string' => 'نام کاربر باید شما حروف باشد',
            'email.string' => 'ایمیل باید شما حروف باشد',
            'name.string' => 'نام کاربر حداکثر 225 کلمه میتواند باشد',
            'email.string' => 'ایمیل  حداکثر 225 کلمه میتواند باشد',
        ];
    }
}
