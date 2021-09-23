<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            Log in
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
            <div class="govuk-form-group">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <!-- Password -->

            <div class="govuk-form-group">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" type="password" name="password" required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="govuk-checkboxes" data-module="govuk-checkboxes">
                <div class="govuk-checkboxes__item">
                    <input class="govuk-checkboxes__input" id="remember_me" name="remember" type="checkbox">
                    <label class="govuk-label govuk-checkboxes__label" for="remember_me">
                        {{ __('Remember me') }}
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="govuk-link"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
