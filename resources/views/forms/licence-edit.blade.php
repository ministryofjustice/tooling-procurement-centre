<x-app-layout>
    <x-form-card>
        <x-slot name="title">
            <span class="govuk-caption-xl">Editing licence #{{ $licence['id'] }} for [cost_centre]</span>
            {!! $licence->tool->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('licences-patch', $licence->id) }}">
            @csrf
            {!! method_field('patch') !!}

            {{-- Tool ID --}}
            <x-input
                name="tool_id"
                type="hidden"
                value="{!! $licence->tool->id !!}"
            ></x-input>

            {{-- Description --}}
            <x-form-group
                id="description"
                label="Description"
                summary="Optionally describe the this licence."
                type="textarea"
                value="{{ $licence->description ?? '' }}"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>
    </x-form-card>
</x-app-layout>
