@extends('layouts.app', [
    'title' => 'Team History',
    'active' => 'Team History',
    'pageTitle' => 'Team Attendance History'
])

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Team attendance history</h1>
            <p class="text-xs text-slate-500 mt-1">
                Attendance logs for direct reports in your team
            </p>
        </div>

        <span class="px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg text-xs font-semibold">
            Manager Scope
        </span>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 mb-6 shadow-2xs">
        <form method="GET" action="{{ route('manager.team-history') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">
            <div>
                <label for="search" class="block text-[11px] font-semibold text-slate-600 mb-1">Search Direct Report</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Name..."
                    class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600"
                >
            </div>

            <div>
                <label for="date" class="block text-[11px] font-semibold text-slate-600 mb-1">Filter Date</label>
                <input
                    type="date"
                    id="date"
                    name="date"
                    value="{{ $date }}"
                    class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600"
                >
            </div>

            <div class="flex gap-2">
                <button type="submit" class="w-full py-1.5 px-3 bg-[#0F766E] hover:bg-teal-800 text-white rounded-lg text-xs font-semibold shadow-2xs transition cursor-pointer">
                    Apply Filter
                </button>
                <a href="{{ route('manager.team-history') }}" class="py-1.5 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-medium text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Team Attendance Table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3.5">Employee</th>
                        <th class="px-6 py-3.5">Date</th>
                        <th class="px-6 py-3.5">Shift</th>
                        <th class="px-6 py-3.5">Check-in / Out</th>
                        <th class="px-6 py-3.5">Late (mins)</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Review Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($attendances as $att)
                        @php
                            $statusVal = $att->status?->value ?? (string) $att->status;
                            $reviewVal = $att->review_status?->value ?? (string) $att->review_status;

                            $statusBadge = match (strtolower($statusVal)) {
                                'present', 'hadir' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'late', 'terlambat' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'early_leave', 'pulang_cepat' => 'bg-orange-50 text-orange-700 border-orange-200',
                                default => 'bg-slate-100 text-slate-700 border-slate-200',
                            };

                            $reviewBadge = match (strtolower($reviewVal)) {
                                'approved', 'disetujui' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'rejected', 'ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                default => 'bg-amber-50 text-amber-700 border-amber-200',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-3.5">
                                <div class="font-medium text-slate-900">{{ $att->employee?->full_name }}</div>
                                <div class="text-[10px] text-slate-400">{{ $att->employee?->employee_code }}</div>
                            </td>
                            <td class="px-6 py-3.5 font-medium text-slate-800">
                                {{ \Carbon\Carbon::parse($att->attendance_date)->translatedFormat('M d, Y') }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-500">
                                {{ $att->workShift?->name ?? 'Standard' }}
                            </td>
                            <td class="px-6 py-3.5 font-mono text-slate-700">
                                {{ $att->check_in_time ? \Carbon\Carbon::parse($att->check_in_time)->format('H:i') : '--:--' }}
                                <span class="text-slate-300">/</span>
                                {{ $att->check_out_time ? \Carbon\Carbon::parse($att->check_out_time)->format('H:i') : '--:--' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-600">
                                {{ $att->late_minutes > 0 ? $att->late_minutes . ' min' : '-' }}
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium border {{ $statusBadge }}">
                                    {{ ucfirst($statusVal) }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium border {{ $reviewBadge }}">
                                    {{ ucfirst($reviewVal) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-xs text-slate-400">
                                Belum ada data presensi tim yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($attendances->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                {{ $attendances->links() }}
            </div>
        @endif
    </div>
@endsection

