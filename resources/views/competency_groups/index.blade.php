<x-app-layout>

    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 p-6 bg-white shadow-sm rounded-lg">

            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="border text-left px-2 bg-slate-100">Competency Groups</th>
                        <th class="border bg-slate-100">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($competency_groups as $competency_group)
                        <tr>
                            <td class="border px-2 text-lg text-gray-900">
                                {{ $competency_group->group_name }}
                            </td>
                            <td class="border text-center">
{{--                            @if ($competency_group->user->is(auth()->user())) --}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('competency_groups.edit',$competency_group)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('competency_groups.destroy',$competency_group) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('competency_groups.destroy',$competency_group)" onclick="event.preventDefault(); this.closest('form').submit();">
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

        <x-primary-button-link :href="route('competency_groups.create')" class="mt-4">{{ __('Add Competency Group') }}</x-primary-button>
 
    </div>
</x-app-layout>