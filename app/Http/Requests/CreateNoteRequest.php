<?php

namespace App\Http\Requests;

use App\Rules\CheckCaptcha;
use App\Rules\CheckContent;
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
            'parent_id' => ['nullable', 'string', "exists:App\Models\Note,id"],
            // 'g-recaptcha-response' => ['required', new CheckCaptcha],
        ];
    }
}
