<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <x-crud-index-header route="{{ route('contacts-create') }}" title="{{ __('Contacts') }}"></x-crud-index-header>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Tooling Contacts</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Email</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($contacts as $contact)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $contact->path() }}"> {{ $contact->name }} </x-nav-link>
                </th>
                <td class="govuk-table__cell">{{ $contact->email }}</td>
                <td class="govuk-table__cell">
                    <x-nav-link href="{{ $contact->path() }}" class="govuk-button"> View</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
