<header class="border-b pb-4 mb-4">
    <h2 class="text-2xl font-semibold text-gray-800">
        {{ __('Informasi Akun') }}
    </h2>
    <p class="mt-2 text-gray-600">
        {{ __('Ubah informasi akun anda.') }}
    </p>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('patch')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="nama_user" type="text"
            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
            :value="old('name', $user->nama_user)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email"
            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
            :value="old('email', $user->email)" required autocomplete="username" />
        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div class="mt-4">
                <p class="text-gray-700">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-blue-600 hover:text-blue-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between">
        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
