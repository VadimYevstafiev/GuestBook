<?php

namespace App\Http\Requests;

use App\Rules\NoteRequest\CheckContent;
use App\Rules\NoteRequest\CheckFiles;
use App\Rules\NoteRequest\CheckRecaptcha;
use Illuminate\Foundation\Http\FormRequest;

class CreateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string',  new CheckContent],
            'parent' => ['nullable', 'json'],
            'g-recaptcha-response' => ['required', 'exclude', new CheckRecaptcha],
            'files' => ['nullable', new CheckFiles]
        ];
    }

            /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Enter the captcha',
        ];
    }
}
