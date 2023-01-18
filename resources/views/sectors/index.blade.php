<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($sectors as $sector)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">sectors</span>
                            </div>
{{--                            @if ($sector->user->is(auth()->user())) --}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('sectors.edit', $sector)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('sectors.destroy', $sector) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('sectors.destroy', $sector)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
{{--                            @endif --}}
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $sector->sector_name }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $sector->industry_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <x-primary-button-link :href="route('sectors.create')" class="mt-4">{{ __('Add sector') }}</x-primary-button>
 
    </div>
</x-app-layout>