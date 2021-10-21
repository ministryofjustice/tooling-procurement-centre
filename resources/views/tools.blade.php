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
            @php
                // 3 states: NEW = 2; APPROVED = 1; REJECTED = 0
                $now = \Carbon\Carbon::now();
                $approved = (!$tool->approved && $tool->created_at->diff($now)->days < 3
                    ? 2
                    : $tool->approved
                );
                $approved_state = ($approved === 2
                    ? 'new'
                    : (!$approved ? 'rejected' : 'approved'))
            @endphp
            <tr class="govuk-table__row">
                <td class="govuk-table__cell">
                    <strong class="govuk-tag govuk-tag--{{$approved === 2 ? 'green' : (!$approved ? 'red' : 'turquoise')}}">
                        {{ $approved_state }}
                    </strong>
                </td>
                <th scope="row" class="govuk-table__header">
                    <x-nav-link
                        href="{{ $tool->path() }}"
                        class="govuk-link--no-visited-state{{$approved === 2 ? ' tooling-new' : (!$approved ? ' tooling-unapproved' : '')}}"
                        title="{{ $tool->name }} has been evaluated and is {{ $approved_state }}"
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
