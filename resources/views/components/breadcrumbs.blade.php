@php
    $buildUrl = route('dashboard');
@endphp
@if(!Route::is('dashboard'))
<div class="govuk-breadcrumbs govuk-breadcrumbs--collapse-on-mobile">
    <ol class="govuk-breadcrumbs__list">
        <li class="govuk-breadcrumbs__list-item">
            <a href="{{ $buildUrl }}">Home</a>
        </li>
        @foreach ($paths as $path)
            @php
                $buildUrl = $buildUrl . '/' . $path;
            @endphp
            @if(!empty($path))
                <li class="govuk-breadcrumbs__list-item">
                    @if($loop->last)
                        {{ str_replace('-', ' ', $path) }}
                    @else
                        <a class="govuk-breadcrumbs__link" href="{{ $buildUrl }}">
                            {{ str_replace('-', ' ', $path) }}
                        </a>
                    @endif
                </li>
            @endif
        @endforeach
    </ol>
</div>
@endif
