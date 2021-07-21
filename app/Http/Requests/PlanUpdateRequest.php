<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanUpdateRequest extends FormRequest
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
            'name' => ['required'],
            'description' => ['required'],
            'validityTime' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است',
            'description.required' => 'وارد کردن مدت زمان اعتبار طرح الزامی است',
            'validityTime.numeric' => 'مدت زمان اعتبار طرح را به عدد وارد کنید',
            'validityTime.min' => 'حداقل مدت زمان اعتبار طرح 1 روز است',
            'price.numeric' => 'قیمت باید عدد باشد',
            'star.min' => 'حداقل امتیاز باید 1 باشد ',
            'price.min' => 'حداقل قیمت باید 1 باشد ',
            'price.required' => 'وارد کردن قیمت الزامی است',
        ];
    }
}
