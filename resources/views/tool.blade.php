<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <span class="govuk-caption-@if(strlen($tool->description) > 60)l @else()xl @endif">{{ $tool->description }}</span>
    <h1 class="govuk-heading-xl">{{ $tool->name }} </h1>

    <x-tool-approved-banner approved="{{ $tool->approved }}" tool_id="{{$tool->id}}" />

    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <a id="timeline"></a>
            <h2 class="govuk-heading-m">Timeline</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
        </div>
        <div class="govuk-grid-column-one-third">
            <h2 class="govuk-heading-m">Main contact</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">

            <h2 class="govuk-heading-m">Licences</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
        </div>
    </div>
</x-app-layout>
