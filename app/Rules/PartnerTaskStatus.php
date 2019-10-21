<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PartnerTaskStatus implements Rule
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
        return in_array($value, ['0', '4', '5', '8', '10', '12']);
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
