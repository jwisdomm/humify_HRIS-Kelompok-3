<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-xs text-slate-400 mb-1.5">{{ $label }}</label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full appearance-none border border-slate-200 rounded-lg px-4 py-2.5 pr-9 text-sm text-slate-700 bg-white bg-[url("data:image/svg+xml,%3Csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20viewBox=%270%200%2020%2020%27%20fill=%27%2394a3b8%27%3E%3Cpath%20fill-rule=%27evenodd%27%20d=%27M5.23%207.21a.75.75%200%20011.06.02L10%2011.168l3.71-3.938a.75.75%200%20111.08%201.04l-4.25%204.5a.75.75%200%2001-1.08%200l-4.25-4.5a.75.75%200%2001.02-1.06z%27%20clip-rule=%27evenodd%27/%3E%3C/svg%3E")] bg-[length:1.25rem] bg-[right_0.5rem_center] bg-no-repeat focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500']) }}
    >
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ $value === (string) $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
