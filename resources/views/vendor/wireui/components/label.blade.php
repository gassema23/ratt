<label {{ $attributes->class([
        'block text-sm font-medium',
        'text-negative-600'  => $hasError,
        'opacity-60'         => $attributes->get('disabled'),
        'text-slate-700 dark:text-slate-400' => !$hasError,
    ]) }}>
    {{ $label ?? $slot }}
</label>
