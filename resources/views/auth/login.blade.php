<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="row">
                <div class="col-12">
                    <img style="width: auto; height: auto;" class="mx-auto d-block" src="{{ asset('/dist/img/logo.png')}}">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-center"><b> Agency Management System</b></p>
                </div>
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
           
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="block mt-4">
                <label for="checkbox" class="flex items-center">
                    <input type="checkbox" id="checkbox" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Show Password') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
                <!--                <a href="/register" class="ml-4" role="button">Register</a>-->
            </div>
        </form>
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('#checkbox').on('change', function() {
                    $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
                });
            });
        </script>
    </x-jet-authentication-card>
</x-guest-layout>