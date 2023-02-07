<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('competency_groups.store') }}">
            @csrf
            <x-input-label for="group-name" :value="__('Competency Group Name')" />
            <x-text-input id="group-name" name="group_name" type="text" class="mt-1 block w-full" :value="old('group_name')" required autofocus autocomplete="group-name" />
            <x-input-error :messages="$errors->get('group_name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('competency_groups.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>