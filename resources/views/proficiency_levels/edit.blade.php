<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('proficiency_levels.update', $proficiencyLevel) }}">
            @csrf
            @method('patch')
            <x-input-label for="level-name" :value="__('Proficiency Level')" />
            <x-text-input id="level-name" name="level_name" type="text" class="mt-1 block w-full" :value="old('level_name', $proficiencyLevel->level_name)" required autofocus autocomplete="level-name" />
            <x-input-error :messages="$errors->get('level_name')" class="mt-2" />
            <x-input-label for="level-description" :value="__('Description')" />
            <x-text-input id="level-description" name="level_description" type="text" class="mt-1 block w-full" :value="old('level_description', $proficiencyLevel->level_description)" required autofocus autocomplete="level-description" />
            <x-input-error :messages="$errors->get('level_description')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('proficiency_levels.show', $proficiencyLevel->id) }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
