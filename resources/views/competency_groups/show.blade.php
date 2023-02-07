<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
{{--            @foreach ($competencyGroups as $competencyGroup) --}}
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">Competency Group</span>
                            </div>
{{--                            @if ($competencyGroup->user->is(auth()->user())) --}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('competency_groups.edit', $competencyGroup)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
{{--                            @endif --}}
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $competencyGroup->group_name }}</p>
                    </div>
                </div>
{{--            @endforeach --}}
        </div>

    </div>
</x-app-layout>