<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-login']) }} style="width: 100%;">
    {{ $slot }}
</button>
