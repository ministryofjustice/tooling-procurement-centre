<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Dashboard') }}</h1>

    <div class="govuk-grid-row">
        <x-card title="Tools" count="{{$data['tooling']['count']}}">
            <x-nav-link href="{{ route('tools') }}" class="govuk-link--no-visited-state">View all</x-nav-link>
        </x-card>
        <x-card title="Licences" count="{{$data['licences']['count']}}">
            <x-nav-link href="{{ route('licences') }}" class="govuk-link--no-visited-state">View all</x-nav-link>
        </x-card>
        <x-card title="Business Cases" count="{{$data['business-cases']['count']}}">
            <x-nav-link href="{{ route('business-cases') }}" class="govuk-link--no-visited-state">View all</x-nav-link>
        </x-card>
    </div>
    <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
    <div class="govuk-grid-row">
        <x-card title="Organisations" count="{{$data['organisations']['count']}}">
            <x-nav-link href="{{ route('organisations') }}" class="govuk-link--no-visited-state">View all</x-nav-link>
        </x-card>
        <x-card title="Teams" count="{{$data['teams']['count']}}">
            <x-nav-link href="{{ route('teams') }}" class="govuk-link--no-visited-state">View all</x-nav-link>
        </x-card>
        <x-card title="Contacts" count="{{$data['contacts']['count']}}">
            <x-nav-link href="{{ route('contacts') }}" class="govuk-link--no-visited-state">View all</x-nav-link>
        </x-card>
    </div>

</x-app-layout>
