@props([
'id' => null,
'label' => null,
'summary' => null,
'type' => null,
'required' => false,
'autofocus' => false,
'autocomplete' => false
])

@isset ($id, $type)
<div class="govuk-form-group">
    <x-label class="govuk-label" for="{{ $id }}">
        {{ $label }}
    </x-label>
    @isset ($summary)
        <x-summary id="{{ $id }}-hint">
            {{ $summary }}
        </x-summary>
    @endif
    @switch($type)
        @case('text')
            <x-input id="{{ $id }}" type="text" name="{{ $id }}" :value="old('{{ $id }}')" :required="$required" :autofocus="$autofocus" />
        @break
        @case('password')
            <x-input id="{{ $id }}"
                     type="password"
                     name="{{ $id }}"
                     :required="$required"
                     :autocomplete="$autocomplete" />
        @break

        @case('textarea')
            <x-textarea id="{{ $id }}" name="{{ $id }}" :value="old('{{ $id }}')" :required="$required" />
        @break
    @endswitch
</div>
@endif
