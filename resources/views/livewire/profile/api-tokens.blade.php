<?php

use function Livewire\Volt\{state};
use App\Models\User;
use Livewire\Volt\Component;

new class extends Component {
    public string $token_name = '';

    public function createApiToken(): void
    {
        $user = auth()->user();
        $token = $user->createToken($this->token_name);

        session()->flash('created_token', $token->plainTextToken);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Generate API tokens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure you check who you will be sharing these with.') }}
        </p>
    </header>
    <form wire:submit="createApiToken" class="mt-6 space-y-6">
        <div>
            <x-input-label for="token_name" :value="__('Token Name')" />
            <x-text-input wire:model="token_name" id="token_name" name="token_name" type="text" class="mt-1 block w-full"
                required autofocus autocomplete="token_name" />
            <x-input-error class="mt-2" :messages="$errors->get('token_name')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>

            @if (session('created_token'))
                <div class="mr-3 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('tokens.token_created', ['token' => session('created_token')]) }}
                </div>
            @endif
        </div>
    </form>

</section>
