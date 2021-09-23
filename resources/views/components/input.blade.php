@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'govuk-input govuk-!-width-one-half']) !!}>

