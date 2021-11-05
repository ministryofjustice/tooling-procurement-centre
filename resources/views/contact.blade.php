<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('contacts') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <h1 class="govuk-heading-xl">{{ $contact['name'] }}</h1>

    @if(isset($contact->tools) && count($contact->tools) > 0)
        <p class="govuk-body">Main contact for the following tools</p>
        <ol class="govuk-list">
            @foreach($contact->tools as $tool)
                <li>
                    <x-nav-link href="{{ $tool->path() }}">{{$tool->name}}</x-nav-link>
                </li>
            @endforeach
        </ol>
    @else
        <p class="govuk-body">This contact is not associated with any tools.</p>
    @endif
</x-app-layout>
