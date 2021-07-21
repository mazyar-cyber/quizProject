<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'title' => 'required',
            'video' => ['required', 'max:38000','mimes:mpeg,mkv,avi,mp4']
        ];
    }

    public function messages()
    {
        return [
            'video.required' => 'بارگذاری ویدیو الزامی است',
            'title.required' => 'عنوانی برای ویدیو بنویسید',
            'video.max' => 'ویدیو نباید بیشتر از 38 مگابایت باشد',
            'video.mimetypes' => ' فرمت ویدیو باید mpeg یا  aviیا mkv  یا mp4 باشد'
        ];
    }
}
