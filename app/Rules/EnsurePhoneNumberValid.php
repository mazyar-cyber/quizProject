<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EnsurePhoneNumberValid implements Rule
{

    protected $phoneNumber;

    /**
     * Create a new rule instance.
     *
     * @param $email
     */
    public function __construct($number)
    {
        $this->phoneNumber = $number;
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
        return $this->phoneNumber == Auth::user()->phoneNumber;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره تلفن را  اشتباه وارد کرده اید';
    }
}
