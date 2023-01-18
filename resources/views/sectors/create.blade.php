<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('sectors.store') }}">
            @csrf
            <x-input-label for="industry-name" :value="__('Industry Name')" />
            <x-forms.select id="industry-name" name="industry_name" :options="$options" type="select" class="mt-1 block w-full" :value="old('industry_name')" required autofocus autocomplete="industry-name" />
            <x-input-error :messages="$errors->get('industry_name')" class="mt-2" />
            <x-input-label for="sector-name" :value="__('Sector Name')" />
            <x-text-input id="sector-name" name="sector_name" type="text" class="mt-1 block w-full" :value="old('sector_name')" required autofocus autocomplete="sector-name" />
            <x-input-error :messages="$errors->get('sector_name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('sectors.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>