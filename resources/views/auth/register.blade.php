<x-guest-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-5 m-x-auto pull-xs-none vamiddle">
                <div class="card">
                    <div class="card-block p-a-2">
                        <div class="text-xs-center">
                            <h2>{{ __('words.Sign up') }}</h2>
                            <p class="text-muted">{{ __('words.create new') }} !</p>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group m-b-1">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        required class="form-control en" placeholder="{{ __('words.user name') }}">
                                </div>
                                <span class="help-block text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b-1">
                                    <span class="input-group-addon">@</span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        required class="form-control en"
                                        placeholder="{{ __('words.enter your email address') }}">
                                </div>
                                <span class="help-block text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b-1">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input id="password" type="password" name="password" required
                                        autocomplete="new-password" class="form-control en"
                                        placeholder="{{ __('words.enter your password') }}">
                                </div>
                                <span class="help-block text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b-2">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        required class="form-control en" placeholder="{{ __('words.confirm pass') }}">
                                </div>
                                <span class="help-block text-danger">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <button type="submit" class="btn btn-block btn-success">
                                <i class="icon-user-follow"></i>
                                {{ __('words.create now') }}
                            </button>
                        </form>
                        <div class="text-xs-center"
                            style="
                        margin-top: 10px;
                    ">
                            <span>{{ __('words.have account') }}
                                <a href="{{ route('login') }}">
                                    {{ __('words.sign') }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
