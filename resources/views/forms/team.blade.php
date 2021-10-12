<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('teams') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Create a team
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('teams') }}">
            @csrf

            {{-- Select a team --}}
            <x-form-group
                id="name"
                label="Team"
                summary="What is the team name?"
                type="text"
                :required="true"
                :autofocus="true"
            />

            {{-- comms_url --}}
            <x-form-group
                id="comms_url"
                label="Comms URL"
                summary="Used to deliver important messages about tooling or licences.<br>Currently supported: Slack channel handle in the form of; #the-channel"
                type="text"
            />

            <x-label>
                Organisation
            </x-label>
            <x-summary>Please select one</x-summary>
            <div class="govuk-radios" data-module="govuk-radios">
                @foreach($organisations as $organisation)
                    <div class="govuk-radios__item">
                        <input class="govuk-radios__input" id="organisation-{{ $loop->index }}" name="organisation_id" type="radio"
                               value="{{$organisation->id}}" required>
                        <label class="govuk-label govuk-radios__label" for="organisation-{{ $loop->index }}">
                            {{ $organisation->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <hr class="govuk-section-break govuk-section-break--xl govuk-section-break--visible">
            <div>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
