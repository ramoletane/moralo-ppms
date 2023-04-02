<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('skill_development_methods.store') }}">
            @csrf
            <x-input-label for="method-name" :value="__('Method Name')" />
            <x-forms.select id="method-name" name="method_name" :options="$options" type="select" class="mt-1 block w-full" :value="old('method_name')" required autofocus autocomplete="method-name" />
            <x-input-error :messages="$errors->get('method_name')" class="mt-2" />
            <x-input-label for="skill-name" :value="__('Skill Name')" />
            <x-text-input id="skill-name" name="skill_name" type="text" class="mt-1 block w-full" :value="old('skill_name')" required autofocus autocomplete="skill-name" />
            <x-input-error :messages="$errors->get('skill_name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('skill_development_methods.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>