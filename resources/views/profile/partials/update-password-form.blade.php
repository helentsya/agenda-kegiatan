<header class="border-b pb-4 mb-4">
    <h2 class="text-2xl font-semibold text-gray-800">
        {{ __('Ubah Password') }}
    </h2>
    <p class="mt-2 text-gray-600">
        {{ __('Pastikan anda memasukkan password dengan kombinasi angka dan symbol untuk menghindari pembajakan.') }}
    </p>
</header>

<form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
        <x-text-input id="update_password_current_password" name="current_password" type="password"
            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
            autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500" />
    </div>

    <div>
        <x-input-label for="update_password_password" :value="__('New Password')" />
        <x-text-input id="update_password_password" name="password" type="password"
            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
            autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500" />
    </div>

    <div>
        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
            autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500" />
    </div>

    <div class="flex items-center justify-between">
        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
