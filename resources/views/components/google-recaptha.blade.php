@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

<div class="mb-4">
    <div class="g-recaptcha" data-sitekey="{{ config('custom.g_recaptcha.key') }}" ></div>
    <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
</div>