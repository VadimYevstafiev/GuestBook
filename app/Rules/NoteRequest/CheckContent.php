<?php

namespace App\Rules\NoteRequest;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckContent implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Проверяем наличие тегов
        if ((bool) preg_match_all('/<[^>]+>/', $value)) {
            preg_match_all('/<[^>]+>.*?<\/[^>]+>/', $value, $matches);
            //Проверяем наличие недопустимых тегов
            foreach($matches[0] as $math) {
                if (!preg_match('/<a +href.*?=[\"^\”^\'].*?[\"^\”^\'].*title.*?=[\"^\”^\'].*?[\"^\”^\']>.*?<\/a>/', $math)
                    && !preg_match('/<code>.*?<\/code>/', $math)
                    && !preg_match('/<i>.*?<\/i>/', $math)
                    && !preg_match('/<strong>.*?<\/strong>/', $math)) {
                        $fail("There are invalid tags");
                        return;
                }
            }
            //Проверяем закрытие тегов
            if (preg_match_all('/<a +href.*?=[\"^\”^\'].*?[\"^\”^\'].*title.*?=[\"^\”^\'].*?[\"^\”^\']>/', $value) 
                !== preg_match_all('/<a +href.*?=[\"^\”^\'].*?[\"^\”^\'].*title.*?=[\"^\”^\'].*?[\"^\”^\']>.*?<\/a>/', $value)
                && preg_match_all('/<code>/', $value) !== preg_match_all('/<code>.*?<\/code>/', $value)
                && preg_match_all('/<i>/', $value) !== preg_match_all('/<i>.*?<\/i>/', $value)
                && preg_match_all('/<strong>/', $value) !== preg_match_all('/<strong>.*?<\/strong>/', $value)) {
                    $fail("There are unclosed tags");
                    return;
            }

        }
    }
}
