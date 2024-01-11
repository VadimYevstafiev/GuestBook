<?php

namespace App\Rules\NoteRequest;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckRecaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secret = config('custom.g_recaptcha.secret');
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = $value;
        $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
        $arr = json_decode($rsp, TRUE);
        if (!$arr['success']) {
            $fail("Error in Google reCAPTACHA");
        }
    }
}
