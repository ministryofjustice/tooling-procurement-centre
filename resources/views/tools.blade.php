
<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Tooling') }}</h1>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Tools and descriptions</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Tool</th>
            <th scope="col" class="govuk-table__header">Description</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
    @foreach($tools as $tool)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $tool->path() }}"> {{ $tool->name }} </x-nav-link>
                </th>
                <td class="govuk-table__cell">{{ $tool->description }}</td>
                <td class="govuk-table__cell">
                    <x-nav-link href="{{ $tool->path() }}" class="govuk-button"> View </x-nav-link>
                </td>
            </tr>
    @endforeach
            </tbody>
        </table>

</x-app-layout>