<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('organisations') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <h1 class="govuk-heading-xl">{{ $organisation->name }}</h1>
</x-app-layout>
