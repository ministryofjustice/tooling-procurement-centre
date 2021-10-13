@props(['disabled' => false, 'required' => false, 'value' => ''])

<textarea
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
    {!! $attributes->merge(['class' => 'govuk-textarea govuk-!-width-one-half']) !!}>{!! $value !!}</textarea>

