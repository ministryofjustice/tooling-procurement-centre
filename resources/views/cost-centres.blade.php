<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Licences') }}</h1>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Licences</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($cost_centres as $cost_centre)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="#"> The Name </x-nav-link>
                </th>
                <td class="govuk-table__cell align-right">
                    <x-nav-link href="#" class="govuk-button"> View</x-nav-link>
                    <x-nav-link href="#" class="govuk-button"> Edit</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
