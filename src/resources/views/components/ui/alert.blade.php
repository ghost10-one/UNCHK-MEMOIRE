@props([
    'type' => 'success',
    'dismissible' => false,
])

@php
    $styles = match ($type) {
        'success' => 'border-success/30 bg-success-light text-success-dark dark:bg-green-900/20 dark:text-green-200',
        'danger' => 'border-danger/30 bg-danger-light text-danger-dark dark:bg-red-900/20 dark:text-red-200',
        'warning' => 'border-warning/30 bg-warning-light text-warning-dark dark:bg-yellow-900/20 dark:text-yellow-200',
        'info', 'secondary' => 'border-secondary/30 bg-secondary-50 text-secondary-700 dark:bg-cyan-900/20 dark:text-cyan-200',
        default => 'border-surface-tertiary bg-surface-secondary text-content-secondary dark:border-dark-border dark:bg-dark-bg dark:text-dark-text',
    };
@endphp

<div
    {{ $attributes->merge(['class' => "flex items-start gap-3 rounded-2xl border p-4 text-sm {$styles}"]) }}
    @if ($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
    role="alert"
>
    <div class="min-w-0 flex-1">{{ $slot }}</div>

    @if ($dismissible)
        <button type="button"
                @click="show = false"
                class="shrink-0 rounded-lg opacity-70 transition hover:opacity-100 focus-ring"
                aria-label="Fermer l'alerte">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    @endif
</div>
