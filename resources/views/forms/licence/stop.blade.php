<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Stop date
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-store-session', 'stop') }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            {{-- Stop date --}}
            <x-form-group
                id="stop"
                label="What is the expiration date for this licence?"
                type="date"
                :value="$licence['stop'] ?? ''"
                :required="true"
                :autofocus="true"
            />

            <div>
                <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
                <x-button>
                    {{ __('Continue') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
