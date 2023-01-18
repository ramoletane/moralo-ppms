<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('impacts.update', $impact) }}">
            @csrf
            @method('patch')
            <x-input-label for="impact-name" :value="__('Impact Name')" />
            <x-text-input id="impact-name" name="impact_name" type="text" class="mt-1 block w-full" :value="old('impact_name', $impact->impact_name)" required autofocus autocomplete="impact-name" />
            <x-input-error :messages="$errors->get('impact_name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('impacts.show', $impact->id) }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
