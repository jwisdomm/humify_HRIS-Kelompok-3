@extends('layouts.app', [
    'title' => 'Leave & Requests',
    'active' => 'Leave & Requests',
    'pageTitle' => 'Leave & Requests'
])

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">My leave &amp; requests</h1>
            <p class="text-xs text-slate-500 mt-1">
                Balance breakdown and request history &middot; {{ $employee?->full_name ?? $user->username }} ({{ $employee?->employee_code ?? 'EMP' }})
            </p>
        </div>

        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-xs border border-slate-200">
            <svg class="w-3.5 h-3.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Read-only: Submit via mobile app</span>
        </div>
    </div>

    {{-- Leave Balances Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @forelse ($balances as $bal)
            @php
                $remaining = $bal->total_days - $bal->used_days;
            @endphp
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs">
                <span class="text-xs font-medium text-slate-500">{{ $bal->leaveType?->name ?? 'Leave' }} &middot; remaining</span>
                <div class="text-2xl font-bold text-slate-900 mt-2">{{ $remaining }} <span class="text-sm font-normal text-slate-500">Days</span></div>
                <div class="flex items-center justify-between text-xs text-slate-400 mt-3 pt-3 border-t border-slate-100">
                    <span>Year {{ $bal->year }}</span>
                    <span>{{ $bal->total_days }} opening / {{ $bal->used_days }} used</span>
                </div>
            </div>
        @empty
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs col-span-3 text-center text-xs text-slate-400 py-6">
                Belum ada alokasi saldo cuti aktif untuk tahun {{ $currentYear }}.
            </div>
        @endforelse
    </div>

    {{-- Mobile Reminder Banner --}}
    <div class="mb-6 p-4 rounded-xl bg-teal-50/70 border border-teal-200/80 flex items-start gap-3.5 shadow-2xs">
        <div class="w-8 h-8 rounded-lg bg-teal-600/10 text-[#0F766E] flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-xs font-semibold text-teal-900">Pengajuan Izin, Cuti, &amp; Sakit</h4>
            <p class="text-xs text-teal-700/90 mt-0.5 leading-relaxed">
                Untuk mengajukan permohonan baru atau membatalkan permohonan yang masih menunggu, silakan buka <strong>aplikasi mobile Humify</strong>. Status persetujuan akan diperbarui secara otomatis di halaman web ini.
            </p>
        </div>
    </div>

    {{-- Request History Table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
        <div class="px-6 py-4 border-b border-slate-200">
            <h3 class="text-sm font-semibold text-slate-900">Request history</h3>
            <p class="text-xs text-slate-400 mt-0.5">Submitted via Humify Mobile &middot; All time</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3.5">Type</th>
                        <th class="px-6 py-3.5">Dates</th>
                        <th class="px-6 py-3.5">Duration</th>
                        <th class="px-6 py-3.5">Reason</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Decision Note / Reason</th>
                        <th class="px-6 py-3.5">Reviewed By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($requests as $req)
                        @php
                            $statusVal = $req->status?->value ?? (string) $req->status;

                            $statusBadge = match (strtolower($statusVal)) {
                                'approved', 'disetujui' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'rejected', 'ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                'cancelled', 'dibatalkan' => 'bg-slate-100 text-slate-600 border-slate-200',
                                default => 'bg-amber-50 text-amber-700 border-amber-200',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-3.5 font-medium text-slate-800">
                                {{ $req->leaveType?->name ?? 'Leave' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-600">
                                {{ \Carbon\Carbon::parse($req->start_date)->translatedFormat('M d, Y') }}
                                @if ($req->start_date !== $req->end_date)
                                    &ndash; {{ \Carbon\Carbon::parse($req->end_date)->translatedFormat('M d, Y') }}
                                @endif
                            </td>
                            <td class="px-6 py-3.5 text-slate-700 font-semibold">
                                {{ $req->total_days }} {{ $req->total_days > 1 ? 'days' : 'day' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-600 max-w-xs truncate">
                                {{ $req->reason }}
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium border {{ $statusBadge }}">
                                    {{ ucfirst($statusVal) }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-slate-500 max-w-xs truncate">
                                {{ $req->rejection_reason ?? '-' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-500">
                                {{ $req->approver?->employee?->full_name ?? $req->approver?->username ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-xs text-slate-400">
                                Belum ada riwayat permohonan cuti, izin, atau sakit yang diajukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($requests->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
@endsection
