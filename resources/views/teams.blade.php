<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <h1 class="govuk-heading-xl">{{ __('Teams') }}</h1>
    <x-nav-link class="govuk-button" href="{{ route('teams-create') }}">Add new</x-nav-link>
    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Available teams</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Comms URL</th>
            <th scope="col" class="govuk-table__header">Organisation</th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
    @foreach($teams as $team)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    {{ $team->name }}
                </th>
                <td class="govuk-table__cell">{{ $team->comms_url }}</td>
                <td class="govuk-table__cell">{{ $team->organisation->name }}</td>
            </tr>
    @endforeach
            </tbody>
        </table>

</x-app-layout>
