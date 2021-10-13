<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Create a tool
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

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
                summary="Please describe what this tool is used for."
                type="textarea"
                :required="true"
            />

            {{-- Link --}}
            <x-form-group
                id="link"
                label="Admin URL"
                type="text"
                summary="It would be useful if this link directed the user to the suppliers administration dashboard, or
                    a location on the web where the licence for this tool can be managed."
            />

            <div>
                <x-button>
                    {{ __('Save and continue') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
