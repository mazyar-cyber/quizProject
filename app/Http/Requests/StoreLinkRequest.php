<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
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
            'link' => ['required', 'string', 'url'],
            'title' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'link.required' => 'وارد کردن لینک الزامی است',
            'title.required' => 'وارد کردن عنوان الزامی است',
            'link.url' => 'این فرمت از لینک قابل قبول نیست',
            'link.string' => 'لینک عدد نمیتواند باشد',
            'title.string' => 'عنوان نمیتواند عدد باشد',
        ];
    }
}
