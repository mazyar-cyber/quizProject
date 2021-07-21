<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreateRequest extends FormRequest
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
            'pic' => ['file', 'max:1000', 'mimes:jpeg,jpg,png'],
            'question' => ['required', 'string'],
            'answer1' => ['required'],
            'answer2' => ['required'],
            'answer3' => ['required'],
            'answer4' => ['required'],
            'TimeToAnswer' => ['required', 'numeric', 'min:1'],
            'questionStar' => ['required', 'numeric', 'min:1'],
        ];

    }

    public function messages()
    {
        return [
            'pic.max' => 'حجم عکس بیشتر از 1 مگابایت نمیتواند باشد',
            'question.required' => 'نوشتن صورت سوال الزامی است',
            'answer1.required' => 'نوشتن جواب الزامی است',
            'answer2.required' => 'نوشتن جواب الزامی است',
            'answer3.required' => 'نوشتن جواب الزامی است',
            'answer4.required' => 'نوشتن جواب الزامی است',
            'question.string' => 'صورت سوال باید شامل حروف باشد',
            'pic.mimes' => 'فرمت عکس آپلود شده فقط jpeg,jpg,png میتواند باشد',
            'TimeToAnswer.required' => 'تعیین مدت زمان پاسخگویی به سوال الزامی است',
            'questionStar.required' => 'امتیاز سوال را تعیین کنید',
            'TimeToAnswer.numeric' => 'مدت زمان را لطفا به عدد وارد کنید',
            'questionStar.numeric' => 'امتیاز را به عدد وارد کنید',
            'questionStar.min' => 'حداقل امتیاز 1 میتواند باشد',
            'TimeToAnswer.min' => 'حداقل زمان پاسخگویی 1 واحد مذکور میباشد',
        ];
    }
}
