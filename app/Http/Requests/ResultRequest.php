<?php

namespace App\Http\Requests;

use App\Rules\EqueNumberOFQuestion;
use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if (!$this->input('answers')) {
            $this->merge([
                'answers' => [],
            ]);
        }
    }


    public function rules()
    {
        return [
            'answers' => [new EqueNumberOFQuestion($this->input('answers'),$this->input('testId'))]
        ];
    }
}
