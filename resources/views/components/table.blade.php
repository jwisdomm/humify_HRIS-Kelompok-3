<div class="bg-white border border-slate-200 rounded-lg mb-4">
    {{-- Header --}}
    @if ($title)
        <div class="flex items-start justify-between px-6 pt-5 pb-4 border-b border-slate-100">
            <div>
                <p class="text-sm font-semibold text-slate-800">{{ $title }}</p>
                @if ($subtitle)
                    <p class="text-xs text-slate-400 mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @if ($link)
                <a href="{{ $link }}" class="text-xs text-teal-600 hover:underline whitespace-nowrap">{{ $linkLabel }} &rarr;</a>
            @endif
        </div>
    @endif

    {{-- Table --}}
    <table class="w-full text-xs">
        <thead>
            <tr class="text-slate-400 border-b border-slate-100">
                @foreach ($columns as $column)
                    <th class="px-6 py-3 text-left font-medium">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            {{ $slot }}
        </tbody>
    </table>

    {{-- Footer --}}
    @if (isset($footer))
        <div class="px-6 py-3 border-t border-slate-100">
            {{ $footer }}
        </div>
    @endif
</div>
