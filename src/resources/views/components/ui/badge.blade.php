@props([
    'variant' => 'gray',
])

@php
    $classes = match ($variant) {
        'primary' => 'bg-primary-100 text-primary-700 dark:bg-primary-900/40 dark:text-primary-100',
        'success' => 'bg-success-light text-success-dark dark:bg-green-900/30 dark:text-green-200',
        'danger' => 'bg-danger-light text-danger-dark dark:bg-red-900/30 dark:text-red-200',
        'warning' => 'bg-warning-light text-warning-dark dark:bg-yellow-900/30 dark:text-yellow-200',
        'secondary' => 'bg-secondary-100 text-secondary-700 dark:bg-cyan-900/30 dark:text-cyan-200',
        default => 'bg-surface-secondary text-content-secondary dark:bg-dark-bg dark:text-dark-muted',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {$classes}"]) }}>
    {{ $slot }}
</span>
