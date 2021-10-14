<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Dashboard') }}</h1>

    <p class="govuk-body">
    <ul class="govuk-list">
        <li><x-nav-link href="{{ route('tools') }}">Tooling</x-nav-link></li>
        <li><x-nav-link href="{{ route('organisations') }}">Organisations</x-nav-link></li>
        <li><x-nav-link href="{{ route('teams') }}">Teams</x-nav-link></li>
        <li><x-nav-link href="{{ route('contacts') }}">Contacts</x-nav-link></li>
    </ul>
    </p>
</x-app-layout>
