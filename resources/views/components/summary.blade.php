{{-- Define a summary for a form element; input textarea select --}}

<div {{ $attributes }} class="govuk-hint govuk-!-width-two-thirds">
    {!! $value ?? $slot !!}
</div>
