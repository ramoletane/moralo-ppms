<x-app-layout>

    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

        <div class="mt-6 p-6 bg-white shadow-sm rounded-lg">
            <?php $currentIndustryId = 0 ?>
            @foreach ($sectors as $sector)
                @if ($sector->industry_id != $currentIndustryId)
                    <?php $currentIndustryId = $sector->industry_id ?>
                    @if (!$loop->first)
                            </tbody>
                        </table>
                    @endif
                    <div class="grid grid-cols-4 gap-1 mb-4">
                        <div class="mt-4 px-2 bg-slate-50 text-lg font-bold">Industry:</div>
                        <div class="col-span-3 mt-4 px-2 bg-slate-50 text-lg text-gray-900">{{ $sector->industry_name }}</div>
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border text-left px-2 bg-slate-100">Sectors</th>
                                <th class="border bg-slate-100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                        <tr>
                            <td class="border mt-4 px-2 text-lg text-gray-900">
                                {{ $sector->sector_name }}
                            </td>
                            <td class="border text-center">
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
                                        <x-dropdown-link :href="route('sectors.edit', $sector->id)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('sectors.destroy', $sector->id) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('sectors.destroy', $sector->id)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
{{--                            @endif --}}
                            </td>
                        </tr>
                @if ($loop->last)
                        </tbody>
                    </table>
                @endif

            @endforeach

        </div>

        <x-primary-button-link :href="route('sectors.create')" class="mt-4">{{ __('Add sector') }}</x-primary-button>
 
    </div>
</x-app-layout>