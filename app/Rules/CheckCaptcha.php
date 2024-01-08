<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
            $secret = config('custom.g_recaptcha.secret');
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = $_POST['g-recaptcha-response'];
            $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
            $arr = json_decode($rsp, TRUE);
            if (!$arr['success']) {
                $fail("Error in Google reCAPTACHA");
            }
        }
    }
}
