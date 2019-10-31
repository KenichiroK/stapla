<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CompanyTaskStatus implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '13', '14', '15', '16', '17', '18']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '問題が発生しました。時間を置いて再度お試しください。';
    }
}
