<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <x-crud-index-header route="{{ route('tools-create') }}" title="{{ __('Tooling') }}"></x-crud-index-header>

    <table class="govuk-table">
        <thead class="govuk-table__head">
        <tr class="govuk-table__row">
            <th scope="col" class="govuk-table__header">Status</th>
            <th scope="col" class="govuk-table__header">Tool</th>
            <th scope="col" class="govuk-table__header">Description</th>
            <th scope="col" class="govuk-table__header"></th>
        </tr>
        </thead>
        <tbody class="govuk-table__body">
        @foreach($tools as $tool)
            <tr class="govuk-table__row">
                <td class="govuk-table__cell">
                    <strong class="govuk-tag govuk-tag--{{!$tool->approved ? 'red' : 'turquoise'}}">
                        {{!$tool->approved ? 'REJECTED' : 'APPROVED'}}
                    </strong>
                </td>
                <th scope="row" class="govuk-table__header">
                    <x-nav-link
                        href="{{ $tool->path() }}"
                        class="govuk-link--no-visited-state{{!$tool->approved ? ' tooling-unapproved' : ''}}"
                        title="{{ $tool->name }} has been evaluated and {{ $tool->approved ? 'is fit for use.' : 'rejected.' }}"
                    >
                        {{ $tool->name }}
                    </x-nav-link>
                </th>
                <td class="govuk-table__cell">{{ $tool->description }}</td>
                <td class="govuk-table__cell alight-right">
                    <x-nav-link href="{{ $tool->path() }}" class="govuk-button"> View</x-nav-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
