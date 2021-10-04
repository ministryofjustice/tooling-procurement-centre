@props([
'id',
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
            <x-input
                id="{{ $id }}"
                type="text"
                name="{{ $id }}"
                :value="old('{{ $id }}')"
                :required="$required"
                :autofocus="$autofocus"></x-input>
            @break
            @case('password')
            <x-input id="{{ $id }}"
                     type="password"
                     name="{{ $id }}"
                     :required="$required"
                     :autocomplete="$autocomplete"></x-input>
            @break

            @case('textarea')
            <x-textarea
                id="{{ $id }}"
                name="{{ $id }}"
                :value="old('{{ $id }}')"
                :required="$required"></x-textarea>
            @break
        @endswitch
    </div>
@endif
