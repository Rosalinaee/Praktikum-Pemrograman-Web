<x-guest-layout>
    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <input type="hidden" name="role" value="{{ $role }}">

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="'Email'" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus />

            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password" />

            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Error untuk role tidak cocok -->
        @if($errors->has('email'))
            <div class="mt-2 text-red-500 text-sm">
                {{ $errors->first('email') }}
            </div>
        @endif

        <!-- Button -->
        <div class="mt-4">
            <x-primary-button class="w-full">
                {{ __('Login ' . ucfirst($role)) }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
