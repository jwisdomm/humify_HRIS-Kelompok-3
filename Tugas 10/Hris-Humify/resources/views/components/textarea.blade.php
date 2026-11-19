<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-xs text-slate-400 mb-1.5">{{ $label }}</label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes->merge(['class' => 'w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 placeholder-slate-300 resize-none focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500' . ($readonly ? ' bg-slate-50 text-slate-400 cursor-not-allowed' : '')]) }}
    >{{ $value }}</textarea>
</div>
