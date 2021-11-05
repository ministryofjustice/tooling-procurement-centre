<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools') }}" class="govuk-back-link">Back</a>
    </x-slot>

    <span class="govuk-caption-@if(strlen($tool->description) > 60)l @else()xl @endif">{{ $tool->description }}</span>
    <h1 class="govuk-heading-xl">{{ $tool->name }} </h1>
    @php
        // 3 states: NEW = 2; APPROVED = 1; REJECTED = 0
        $approved = 'rejected';
        if (!$tool->approved && $tool->created_at->diff(\Carbon\Carbon::now())->days < 3) {
            $approved = 'new';
        } elseif ($tool->approved) {
            $approved = 'approved';
        }
    @endphp

    <x-tool-approved-banner
        name="{{ $tool->name }}"
        approved="{{ $approved }}"
        tool_id="{{$tool->id}}"/>

    <div class="govuk-grid-row">
        <div class="govuk-grid-column-two-thirds">
            <h2 id="timeline" class="govuk-heading-m">Timeline</h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">

            <table class="govuk-table tooling-timeline">
                <tbody class="govuk-table__body">
                @foreach($tool->events as $event)
                    @php
                        $the_year = $event->created_at->format('Y');
                    @endphp
                    @if($loop->index === 0 || ($the_year !== $tool->events[$loop->index-1]->created_at->format('Y')))
                        <tr class="govuk-table__row">
                            <td class="govuk-table__cell tooling-timeline__item" colspan="2">
                                <div class="tooling-timeline__date-year">
                                    <strong class="govuk-!-font-size-27">{{$the_year}}</strong>
                                </div>
                            </td>
                        </tr>
                    @endif
                    <tr class="govuk-table__row">
                        <td
                            class="govuk-table__cell tooling-timeline__item"
                            title="{{$event->created_at->format('r')}}">
                            <div class="tooling-timeline__date">
                                <strong>{{$event->created_at->format('d M')}}</strong><br>
                                <small>{{$event->created_at->format('H:i')}}</small>
                            </div>
                        </td>
                        <td class="govuk-table__cell">{!! $event->detail !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="govuk-grid-column-one-third tooling-meta-column">
            @if($tool->contact)
                <h2 id="main-contact" class="govuk-heading-m">Main contact</h2>
                <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
                <div class="govuk-inset-text">
                    @php
                        $image = md5( strtolower( trim( $tool->contact->email ) ) );
                    @endphp
                    <img src="https://www.gravatar.com/avatar/{{$image}}" style="float:left;margin-right:10px"/>
                    <strong>{{$tool->contact->name}}</strong><br>
                    <x-nav-link href="mailto:{{$tool->contact->email}}">Email</x-nav-link>
                    @if(!empty($tool->contact->slack))
                        <br>
                        <x-nav-link target="_blank" href="https://mojdt.slack.com/team/{{$tool->contact->slack}}">Slack
                            IM
                        </x-nav-link>
                    @endif
                </div>
            @endif


            <h2 id="licences" class="govuk-heading-m">
                Licences
            </h2>
            <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible"/>
            @if(count($tool->licences) > 0)
                <table class="govuk-table">
                    <thead class="govuk-table__head">
                    <tr class="govuk-table__row">
                        <th scope="col" class="govuk-table__header">Cost</th>
                        <th scope="col" class="govuk-table__header">Users</th>
                        <th scope="col" class="govuk-table__header"></th>
                    </tr>
                    </thead>
                    <tbody class="govuk-table__body">
                    @foreach($tool->licences as $licence)
                        <tr class="govuk-table__row">
                            <td colspan="3" class="govuk-table__cell app-hint no-border">[COST_CENTRE_NAME]</td>
                        </tr>
                        <tr class="govuk-table__row">
                            <th scope="row" class="govuk-table__header">&pound;{{$licence->user_limit * $licence->cost_per_user}}</th>
                            <td class="govuk-table__cell">{{$licence->user_limit}}</td>
                            <td class="govuk-table__cell">
                                <x-nav-link href="{{ route('licence', $licence->id) }}">View</x-nav-link>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="govuk-body">
                    No licences could be found for {{ $tool->name }}.
                </p>
            @endif
            <x-nav-link href="{{route('licences-create', $tool->slug)}}" class="govuk-button">
                Add new licence
            </x-nav-link>
        </div>
    </div>
</x-app-layout>
