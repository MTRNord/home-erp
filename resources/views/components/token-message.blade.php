@props(['on'])

<div x-data="{ shown: false, timeout: null, message: '' }" x-init="@this.on('{{ $on }}', (event) => {
    clearTimeout(timeout);
    shown = true;
    timeout = setTimeout(() => { shown = false }, 2000);
    message = event.detail.token
})" x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm text-gray-600 dark:text-gray-400']) }}>
    <p x-text="message"></p>
</div>
