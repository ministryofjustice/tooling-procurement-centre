<div class="govuk-notification-banner{{ $approved ? ' govuk-notification-banner--success' : '' }}" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
    <div class="govuk-notification-banner__header">
        <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
            {{ $approved ? 'Approved to purchase' : 'Unapproved for use' }}
        </h2>
    </div>
    <div class="govuk-notification-banner__content">
        <div class="tooling-approve">
            <form method="post" action="{{route('tools-approve', $toolId)}}">
                @csrf
                <x-input type="hidden" name="approved" value="{{ $approved ? '0' : '1' }}" />
                <x-button type="submit" class="{{ $approved ? '' : 'govuk-button--warning' }}">
                    {{ $approved ? 'Remove approval' : 'Approve' }}
                </x-button>
            </form>
        </div>
        <h3 class="govuk-notification-banner__heading">
            Tooling has been evaluated and {{ $approved ? 'is fit for use.' : 'rejected.' }}
        </h3>
        <p class="govuk-body">
            {!! $approved
                ? 'View the <a href="'. route('licences.show', $toolId) .'">licence</a> for further information'
                : 'Please <a href="#timeline">review the timeline</a> for further detail.' !!}
        </p>
    </div>
</div>
