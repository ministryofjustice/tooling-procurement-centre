<x-app-layout>
    <x-nav-link class="govuk-button align-right" href="{{ route('licences-edit', $licence['id']) }}">Edit</x-nav-link>
    <span class="govuk-caption-xl">Licence #{{ $licence['id'] }} for [cost_centre]</span>
    <h1 class="govuk-heading-xl">{{ $licence->tool->name }}</h1>

    <p class="govuk-body">
        {{$licence->description ?? ''}}
    </p>

    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <table class="govuk-table">
                <caption class="govuk-table__caption govuk-table__caption--l">Months and rates</caption>
                <thead class="govuk-table__head">
                <tr class="govuk-table__row">
                    <th scope="col" class="govuk-table__header">Month you apply</th>
                    <th scope="col" class="govuk-table__header">Rate for vehicles</th>
                </tr>
                </thead>
                <tbody class="govuk-table__body">
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">January</th>
                    <td class="govuk-table__cell">£95</td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">February</th>
                    <td class="govuk-table__cell">£55</td>
                </tr>
                <tr class="govuk-table__row">
                    <th scope="row" class="govuk-table__header">March</th>
                    <td class="govuk-table__cell">£125</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="govuk-grid-column-one-third">
            <h2 id="timeline" class="govuk-heading-m">Quotes</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
        </div>
    </div>
</x-app-layout>
