<?php

namespace App\Rules;

use App\Models\Questions;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EqueNumberOFQuestion implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param Questions $question
     */
    protected $number;
    protected $testIdd;

    public function __construct($answers, $testId)
    {
        $this->number = count($answers);
        $this->testIdd = $testId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
//        return $this->number == count(Questions::where('test_id', $this->testIdd)->get());
        return $this->number == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'جواب دادن به سوال الزامی است!';
    }
}
