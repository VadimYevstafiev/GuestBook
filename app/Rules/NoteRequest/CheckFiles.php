<?php

namespace App\Rules\NoteRequest;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckFiles implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $file) {
            $type = explode('/', $file->getClientMimeType());
            $type = array_shift($type);

            if (!in_array($type, array_keys(config('custom.files')))) {
                $fail("Invalid MIME type {$file->getClientOriginalName()} file");
                return;
            }

            if (!in_array($file->extension(), config("custom.files.{$type}.ext"))) {
                $fail("Invalid extension {$file->getClientOriginalName()} file");
            }

            if ($type === 'text') {
                if ($file->getSize() > config("custom.notes.text-files.file.size")) {
                    $fail("Invalid size {$file->getClientOriginalName()} file");
                }
            }
        }
    }
}
