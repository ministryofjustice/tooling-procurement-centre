<button {{ $attributes->merge(['type' => 'submit', 'class' => 'govuk-button', 'data-module' => 'govuk-button']) }}>
    {{ $slot }}
</button>
