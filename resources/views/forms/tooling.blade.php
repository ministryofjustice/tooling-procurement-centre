<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Create a tool
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors" />

        <p class="govuk-body">Please be as specific as you can.</p>

        <form method="POST" action="/tools">
            @csrf

            {{-- Name --}}
            <x-form-group
                id="name"
                label="Name"
                summary="What is the name of the tool"
                type="text"
                :required="true"
                :autofocus="true"
            />

            {{-- Description --}}
            <x-form-group
                id="description"
                label="Description"
                summary="This is the description hint"
                type="textarea"
                :required="true"
            />

            {{-- Link --}}
            <x-form-group
                id="link"
                label="Link"
                type="text"
                summary="Something about the link"
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
