@props([
    'title' => null,
    'subtitle' => null,
    'padding' => true,
    'hover' => false,
])

<section {{ $attributes->merge([
    'class' => 'rounded-2xl border border-surface-tertiary bg-white shadow-sm dark:border-dark-border dark:bg-dark-surface'
        . ($padding ? ' p-5 sm:p-6' : ' overflow-hidden')
        . ($hover ? ' transition hover:-translate-y-0.5 hover:shadow-md' : ''),
]) }}>
    @if ($title || $subtitle)
        <header class="{{ $padding ? 'mb-4' : 'border-b border-surface-tertiary px-5 py-4 dark:border-dark-border' }}">
            @if ($title)
                <h3 class="text-base font-bold text-content dark:text-dark-text font-heading">{{ $title }}</h3>
            @endif
            @if ($subtitle)
                <p class="mt-1 text-sm text-content-tertiary dark:text-dark-muted">{{ $subtitle }}</p>
            @endif
        </header>
    @endif

    {{ $slot }}
</section>
