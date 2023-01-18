<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('organisations.store') }}">
            @csrf
            <x-input-label for="company-name" :value="__('Company Name')" />
            <x-text-input id="company-name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name')" required autofocus autocomplete="company-name" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            <x-input-label for="acronym" :value="__('Company Name Acronym')" />
            <x-text-input id="acronym" name="acronym" type="text" class="mt-1 block w-full" :value="old('acronym')" autofocus autocomplete="acronym" />
            <x-input-error :messages="$errors->get('acronym')" class="mt-2" />
            <x-input-label for="email-address" :value="__('Email Address')" />
            <x-text-input id="email-address" name="email_address" type="text" class="mt-1 block w-full" :value="old('email_address')" required autofocus autocomplete="email-address" />
            <x-input-error :messages="$errors->get('email_address')" class="mt-2" />
            <x-input-label for="phone-number" :value="__('Phone Number')" />
            <x-text-input id="phone-number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number')" required autofocus autocomplete="phone-number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('organisations.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>