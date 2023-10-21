<?php

use function Livewire\Volt\{state};
use Livewire\Attributes\Rule;
use App\Models\Room;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Rule(['required', 'string'])]
    public string $roomname = '';

    #[Rule(['required', 'string'])]
    public string $description = '';

    public function createRoom(): void
    {
        $this->validate();
        Room::create([
            'name' => $this->roomname,
            'description' => $this->description,
        ]);
        $this->dispatch('close');
    }

    public function with(): array
    {
        return [
            'rooms' => Room::cursorPaginate(10),
        ];
    }
}; ?>

<section class="space-y-6">
    <header class="flex item justify-between">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Rooms') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('The rooms in your house') }}
            </p>
        </div>

        <button x-on:click.prevent="$dispatch('open-modal', 'create-room')"
            class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            {{ __('Create Room') }}
        </button>
    </header>


    <x-modal name="create-room" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="createRoom" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create Room') }}
            </h2>
            <div class="mt-6">
                <x-input-label for="roomname" value="{{ __('Roomname') }}" class="sr-only" />

                <x-text-input wire:model="roomname" id="roomname" name="roomname" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('Roomname') }}" />

                <x-input-error :messages="$errors->get('roomname')" class="mt-2" />
            </div>

            <div class="mt-3">
                <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />

                <x-text-input wire:model="description" id="description" name="description" type="text"
                    class="mt-1 block w-full" placeholder="{{ __('Description') }}" />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Create Room') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    @if ($rooms->count() > 0)
        <table class="table-fixed w-full border-separate border-spacing-0 rounded-lg text-sm">
            <thead class="bg-gray-700 font-medium text-slate-300 dark:text-slate-200 text-left">
                <tr>
                    <th class="border-b dark:border-slate-600 p-4 pl-8 pt-3 pb-3">
                        {{ __('Name') }}
                    </th>
                    <th class="border-b dark:border-slate-600 p-4 pl-8 pt-3 pb-3">
                        {{ __('Description') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 text-slate-700 dark:text-slate-400">
                @foreach ($rooms as $room)
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8">
                            {{ $room->name }}
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8">
                            {{ $room->description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rooms->links() }}
    @else
        <p class="mt-1 text-base text-gray-800 dark:text-gray-200">
            {{ __('No rooms found. Please create a new Room') }}
        </p>
    @endif
</section>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('flash-nfc', ({
            room_id
        }) => {

        })
    })
</script>
