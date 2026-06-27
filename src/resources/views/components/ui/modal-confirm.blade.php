@props([
    'name' => 'confirm-action',
    'title' => 'Confirmer l action',
    'message' => 'Cette action est irreversible.',
    'confirmText' => 'Confirmer',
    'cancelText' => 'Annuler',
    'variant' => 'danger',
])

@php
    $confirmClass = $variant === 'danger'
        ? 'bg-danger text-white hover:bg-danger-dark'
        : 'bg-primary text-white hover:bg-primary-600';
@endphp

<div
    x-data="{ open: false }"
    x-on:open-modal.window="$event.detail === '{{ $name }}' ? open = true : null"
    x-on:keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
>
    <div class="absolute inset-0 bg-slate-950/50" x-on:click="open = false" aria-hidden="true"></div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-md rounded-2xl border border-surface-tertiary bg-white p-6 shadow-lg dark:border-dark-border dark:bg-dark-surface"
    >
        <h2 id="{{ $name }}-title" class="text-lg font-bold text-content dark:text-dark-text font-heading">{{ $title }}</h2>
        <p class="mt-2 text-sm text-content-secondary dark:text-dark-muted">{{ $message }}</p>

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <button type="button"
                    x-on:click="open = false"
                    class="inline-flex justify-center rounded-xl border border-surface-tertiary px-4 py-2.5 text-sm font-semibold text-content-secondary transition hover:bg-surface-secondary focus-ring dark:border-dark-border dark:text-dark-text dark:hover:bg-dark-bg">
                {{ $cancelText }}
            </button>
            <button type="button"
                    x-on:click="$dispatch('confirmed', { name: '{{ $name }}' }); open = false"
                    class="inline-flex justify-center rounded-xl px-4 py-2.5 text-sm font-semibold transition focus-ring {{ $confirmClass }}">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>
