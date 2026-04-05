<x-guest-layout>
    <style>
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #5B8BC5 0%, #4A7AB5 100%);
            border: none;
            border-radius: 8px;
            padding: 11px 24px;
            font-size: 14px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #4A7AB5 0%, #3A6AA5 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(91, 139, 197, 0.3);
            color: white;
        }
        .btn-login:active {
            transform: translateY(0);
        }
    </style>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" :class="$errors->get('email') ? 'is-invalid' : ''" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" :class="$errors->get('password') ? 'is-invalid' : ''" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" type="password" name="password_confirmation" :class="$errors->get('password_confirmation') ? 'is-invalid' : ''"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn-login">{{ __('Reset Password') }}</button>
        </div>
    </form>
</x-guest-layout>
