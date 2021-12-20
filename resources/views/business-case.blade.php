<x-app-layout>
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-three-quarters">
            <span class="govuk-caption-l">
                Created for <strong>{{ $business_case->licence->tool->name }}</strong>
                under licence #{{ $business_case->licence->id }}
                @if($business_case->licence->costCentre)
                    and cost centre <span title="{{ $business_case->licence->costCentre->name }}">
                        {{ $business_case->licence->costCentre->number }}
                    </span>
                @endif
            </span>
            <h1 class="govuk-heading-xl">{{ $business_case->name }}</h1>
        </div>
    </div>
</x-app-layout>
