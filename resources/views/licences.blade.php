<x-app-layout>
    <x-crud-index-header route="{{ route('licences-create') }}" title="{{ __('Licences') }}"></x-crud-index-header>

    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Licences</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Available</th>
            <th scope="col" class="govuk-table__header">Cost</th>
            <th scope="col" class="govuk-table__header">Expires</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($licences as $licence)
            @php
                $start = ($licence->start ? $licence->start->format('r') : null);
                $stop = ($licence->stop ? $licence->stop->format('r') : null);

            @endphp
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $licence->path() }}"> {{ $licence->tool->name }} </x-nav-link>
                </th>
                @if(!$stop)
                    <td class="govuk-table__cell" colspan="3">
                        <strong class="govuk-tag govuk-tag--blue">
                            Incomplete
                        </strong> Please edit and update to present data here.</td>
                @else
                    <td class="govuk-table__cell">{{ $licence->available }}</td>
                    <td class="govuk-table__cell">{{ $licence->annual_cost }}</td>
                    <td class="govuk-table__cell">{{ $stop }}</td>
                @endif
                <td class="govuk-table__cell alight-right">
                    <x-nav-link href="{{ $licence->path() }}" class="govuk-button"> View</x-nav-link>
                    <x-nav-link href="{{ $licence->path() }}/edit" class="govuk-button"> Edit</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
