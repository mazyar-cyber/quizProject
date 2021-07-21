<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfStoreRequest extends FormRequest
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
            'name' => ['required', 'unique:pdfs'],
            'file' => ['required', 'max:15000', 'mimes:pdf']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا عنوان ویدیو را وارد کنید',
            'file.required' => 'لطفا pdf موردنظر خود را آپلود کنید',
            'file.max' => 'حداکثر حجم پی دی اف 15 مگ میتواند باشد',
            'file.mimes' => 'فرمت فایل آپلودی باید pdf باشد',
            'name.unique' => 'این عنوان قبلا ایجاد شده است',
        ];
    }
}
