<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Dashboard') }}</h1>

    <p class="govuk-body">
        <x-nav-link href="{{ route('tools') }}">View tooling</x-nav-link>
        <br>
        <x-nav-link href="{{ route('tools-create') }}">Create a tool</x-nav-link>
    </p>
    <hr>
    <p class="govuk-body">
        <x-nav-link href="{{ route('organisations-create') }}">New organisation</x-nav-link>
        <br>
        <x-nav-link href="{{ route('teams-create') }}">New team</x-nav-link>
    </p>
</x-app-layout>
