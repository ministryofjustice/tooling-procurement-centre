<x-app-layout>
    <h1 class="govuk-heading-xl">{{ __('Organisations') }}</h1>
    <x-nav-link class="govuk-button" href="{{ route('organisations-create') }}">Add new</x-nav-link>
    <table class="govuk-table">
        <caption class="govuk-table__caption govuk-table__caption--m">Available organisations</caption>
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Name</th>
            <th scope="col" class="govuk-table__header">Address</th>
            <th scope="col" class="govuk-table__header">Description</th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($organisations as $organisation)
            <tr class="govuk-table__row">
                <th scope="row" class="govuk-table__header">
                    <x-nav-link href="{{ $organisation->path() }}"> {{ $organisation->name }} </x-nav-link>
                    @if(count($organisation->teams) > 0)
                        <br><br>
                        <details class="govuk-details" data-module="govuk-details">
                            <summary class="govuk-details__summary">
                                <span class="govuk-details__summary-text">
                                  Teams
                                </span>
                            </summary>
                            <div class="govuk-details__text">

                                @foreach($organisation->teams as $team)
                                    <ul class="govuk-list">
                                        <li class="govuk-!-font-size-16">{{ $team->name }}</li>
                                    </ul>
                                @endforeach
                            </div>
                        </details>
                        @endif
                </th>
                <td class="govuk-table__cell">{{ $organisation->address }}</td>
                <td class="govuk-table__cell">{{ $organisation->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
