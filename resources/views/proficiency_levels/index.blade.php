<x-app-layout>

    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 p-6 bg-white shadow-sm rounded-lg">

            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="border text-left px-2 bg-slate-100">Level Name</th>
                        <th class="border text-left px-2 bg-slate-100">Level Description</th>
                        <th class="border bg-slate-100">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($proficiency_levels as $proficiency_level)
                        <tr>
                            <td class="border px-2 text-lg text-gray-900">
                                {{ $proficiency_level->level_name }}
                            </td>
                            <td class="border px-2 text-lg text-gray-900">
                                {{ $proficiency_level->level_description }}
                            </td>
                            <td class="border text-center">
{{--                            @if ($proficiency_level->user->is(auth()->user())) --}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('proficiency_levels.edit',$proficiency_level)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('proficiency_levels.destroy',$proficiency_level) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('proficiency_levels.destroy',$proficiency_level)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
{{--                            @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <x-primary-button-link :href="route('proficiency_levels.create')" class="mt-4">{{ __('Add Proficiency Level') }}</x-primary-button>
 
    </div>
</x-app-layout>