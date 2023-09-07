<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ThrottleSubmission implements Rule
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
        return auth()->user()->latestMessage != null ? auth()->user()->latestMessage->created_at->lt(
            now()->subMinutes(1440)
            //subSeconds(20);
        ): null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please,submit only once';
    }



}
