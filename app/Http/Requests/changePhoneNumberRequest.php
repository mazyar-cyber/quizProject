<?php

namespace App\Http\Requests;

use App\Rules\EnsurePhoneNumberValid;
use App\Rules\EqueNumberOFQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class changePhoneNumberRequest extends FormRequest
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
            'oldPhoneNumber' => ['required', new EnsurePhoneNumberValid($this->input('oldPhoneNumber'))],
            'phoneNumber' => ['required', 'numeric', 'unique:users'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'لطفا ایمیل خود را وارد کنید',
            'email.email' => 'ورودی شما آدرس یک ایمیل نیست',
            'phoneNumber.numeric' => 'لطفا شماره ی خود را به صورت عدد وارد کنید',
            'phoneNumber.unique' => 'این شماره تلفن قبلا ثبت شده است',
        ];
    }

}
