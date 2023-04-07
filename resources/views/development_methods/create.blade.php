<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('development_methods.store') }}">
            @csrf
            <x-input-label for="method-name" :value="__('Tool/Method to Develop Skills')" />
            <x-text-input id="method-name" name="method_name" type="text" class="mt-1 block w-full" :value="old('method_name')" required autofocus autocomplete="method-name" />
            <x-input-error :messages="$errors->get('method_name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('development_methods.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>