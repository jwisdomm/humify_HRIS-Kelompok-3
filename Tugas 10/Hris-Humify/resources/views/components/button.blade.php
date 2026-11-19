@php
    $classes = match ($variant) {
        'primary' => 'bg-teal-700 text-white hover:bg-teal-800',
        'secondary' => 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50',
        'link' => 'text-teal-600 hover:text-teal-700 hover:underline',
        default => 'bg-teal-700 text-white hover:bg-teal-800',
    };

    $sizeClasses = match ($variant) {
        'link' => 'text-sm font-medium',
        default => 'px-5 py-2 rounded-lg text-sm font-medium',
    };
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "cursor-pointer transition-colors $sizeClasses $classes"]) }}
>
    {{ $slot }}
</button>
