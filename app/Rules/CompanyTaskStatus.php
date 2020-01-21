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
        return in_array($value, [
            config('const.TASK_CREATE'),
            config('const.TASK_SUBMIT_SUPERIOR'),
            config('const.TASK_APPROVAL_SUPERIOR'),
            config('const.TASK_SUBMIT_PARTNER'),
            config('const.WORKING'),
            config('const.ACCEPTANCE'),
            config('const.SUBMIT_ACCOUNTING'),
            config('const.APPROVAL_ACCOUNTING'),
            config('const.COMPLETE_STAFF'),
            config('const.TASK_CANCELED')
        ]);
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
