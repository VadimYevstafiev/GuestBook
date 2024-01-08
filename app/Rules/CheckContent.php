<?php

namespace App\Rules;

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
        if (isset($_POST['content']) && $_POST['content']) {
            $content = $_POST['content'];
            //Проверяем наличие тегов
            $count = preg_match_all('/<[^>]+>/', $content);
            if ((bool) $count) {
                //Проверяем закрытие тегов
                if ($count - preg_match_all('/<[^>]+>.*?<\/[^>]+>/', $content, $matches) * 2 != 0) {
                    $fail("There are unclosed tags");
                    return;
                }
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
            }
        }
    }
}
