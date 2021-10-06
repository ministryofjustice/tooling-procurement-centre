<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            Create an account
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf


            {{-- Name --}}
            <x-form-group
                id="name"
                label="Name"
                type="text"
                :required="true"
                :autofocus="true"
            />


            {{-- Email --}}
            <x-form-group
                id="email"
                label="Email"
                type="text"
                :required="true"
            />

            {{-- Password --}}
            <x-form-group
                id="password"
                label="Password"
                type="password"
                :required="true"
                :autocomplete="'new-password'"
            />

            {{-- Password Confirmation--}}
            <x-form-group
                id="password_confirmation"
                label="Confirm Password"
                type="password"
                :required="true"
                :autocomplete="'new-password'"
            />

            <div>
                <a class="govuk-link" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <br>
                <br>
                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
