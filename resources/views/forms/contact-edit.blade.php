<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('contacts') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Edit: {!! $contact->name !!}
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('contacts-patch', $contact->id) }}">
            @csrf
            {!! method_field('patch') !!}
            {{-- Name --}}
            <x-form-group
                id="name"
                label="Name"
                type="text"
                value="{!! $contact->name !!}"
                :required="true"
                :autofocus="true"
            />

            {{-- Email --}}
            <x-form-group
                id="email"
                label="Email"
                type="text"
                value="{!! $contact->email !!}"
                :required="true"
            />

            {{-- Slack --}}
            <x-form-group
                id="slack"
                label="Slack ID"
                type="text"
                value="{!! $contact->slack !!}"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>

        </form>
    </x-form-card>
</x-app-layout>
