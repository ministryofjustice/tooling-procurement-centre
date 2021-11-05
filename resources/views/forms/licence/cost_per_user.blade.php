<x-app-layout>
    <span class="govuk-caption-l"><strong>{{ $tool->name }}:</strong> create a new licence</span>
    <x-form-card>
        <x-slot name="title">
            Cost per-user
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-store-session', 'cost_per_user') }}">
            @csrf

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{{ $tool->id }}"
            ></x-input>

            {{-- Single licence cost--}}
            <x-form-group
                id="cost_per_user"
                summary="How much does a single licence cost?"
                type="text"
                value="{{ $licence['cost_per_user'] ?? '' }}"
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
