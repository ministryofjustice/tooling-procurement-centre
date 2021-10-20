<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <span class="govuk-caption-@if(strlen($tool->description) > 60)l @else()xl @endif">{{ $tool->description }}</span>
    <h1 class="govuk-heading-xl">{{ $tool->name }} </h1>

    <x-tool-approved-banner approved="{{ $tool->approved }}" tool_id="{{$tool->id}}"/>

    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <a id="timeline"></a>
            <h2 class="govuk-heading-m">Timeline</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">

            <table class="govuk-table">
                <tbody class="govuk-table__body">
                @foreach($tool->events as $event)
                    @if($loop->index === 0 || ($event->created_at->format('Y') !== $tool->events[$loop->index-1]->created_at->format('Y')))
                        <tr class="govuk-table__row">
                            <td scope="row" class="govuk-table__cell no-border" colspan="2">
                                <div class="tooling-timeline-date-year">
                                    <strong class="govuk-!-font-size-27">{{$event->created_at->format('Y')}}</strong>
                                </div>
                            </td>
                        </tr>
                    @endif
                    <tr class="govuk-table__row">
                        <td scope="row" class="govuk-table__cell">
                            <div class="tooling-timeline-date">
                                <strong>{{$event->created_at->format('d M')}}</strong><br>
                                <small>{{$event->created_at->format('H:i')}}</small>
                            </div>
                        </td>
                        <td class="govuk-table__cell">{{$event->detail}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="govuk-grid-column-one-third">
            @if($tool->contact)
                <h2 class="govuk-heading-m">Main contact</h2>
                <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
                <div class="govuk-inset-text">
                    <strong>{{$tool->contact->name}}</strong><br>
                    {{$tool->contact->email}}<br>
                    Slack: {{$tool->contact->slack}}
                </div>
            @endif

            <h2 class="govuk-heading-m">Licences</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
        </div>
    </div>
</x-app-layout>
