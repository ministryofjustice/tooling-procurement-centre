@props(['disabled' => false, 'required' => false])

<textarea
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
    {!! $attributes->merge(['class' => 'govuk-textarea govuk-!-width-one-half']) !!}>
</textarea>

