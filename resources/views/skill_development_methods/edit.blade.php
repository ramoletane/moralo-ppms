<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('skill_development_methods.update', $skillDevelopmentMethod) }}">
            @csrf
            @method('patch')
            <x-input-label for="method" :value="__('Tool/Method')" />
            <x-forms.select id="method" name="method_id" :options="$options" type="select" class="mt-1 block w-full" :value="old('method')" required autofocus autocomplete="method" />
            <x-input-error :messages="$errors->get('method')" class="mt-2" />
            <x-input-label for="skill-name" :value="__('Skill Name')" />
            <x-text-input id="skill-name" name="skill_name" type="text" class="mt-1 block w-full" :value="old('skill_name', $skillDevelopmentMethod->skill_name)" required autofocus autocomplete="skill-name" />
            <x-input-error :messages="$errors->get('skill_name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('skill_development_methods.show', $skillDevelopmentMethod->id) }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
