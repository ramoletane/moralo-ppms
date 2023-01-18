<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
{{--            @foreach ($organisations as $organisation) --}}
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">Organisation</span>
                            </div>
{{--                            @if ($chirp->user->is(auth()->user())) --}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('organisations.edit', $organisation)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
{{--                            @endif --}}
                        </div>
                        @php
                            $companyName = $organisation->company_name;
                            if ($organisation->acronym) $companyName .= ' (' . $organisation->acronym . ')';
                        @endphp
                        <p class="mt-4 text-lg text-gray-900">{{ $companyName }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $organisation->email_address }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $organisation->phone_number }}</p>
                    </div>
                </div>
{{--            @endforeach --}}
        </div>

    </div>
</x-app-layout>