@extends('layouts.app', [
    'title' => 'Attendance History',
    'active' => 'Attendance History',
    'pageTitle' => 'Attendance History'
])

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">My attendance history</h1>
            <p class="text-xs text-slate-500 mt-1">
                Personal records &middot; {{ $employee?->full_name ?? $user->username }} &middot; {{ $employee?->employee_code ?? 'EMP' }}
            </p>
        </div>

        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-xs border border-slate-200">
            <svg class="w-3.5 h-3.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Read-only: Capture via mobile app</span>
        </div>
    </div>

    {{-- Monthly Metrics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs">
            <span class="text-xs font-medium text-slate-500">Present this month</span>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $stats['present'] }} <span class="text-sm font-normal text-slate-500">Days</span></div>
            <p class="text-[11px] text-slate-400 mt-2">On-time attendances recorded</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs">
            <span class="text-xs font-medium text-slate-500">Late arrivals</span>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $stats['late'] }} <span class="text-sm font-normal text-slate-500">Days</span></div>
            <p class="text-[11px] text-slate-400 mt-2">Arrived after shift start time</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs">
            <span class="text-xs font-medium text-slate-500">Total logs</span>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $stats['records'] }} <span class="text-sm font-normal text-slate-500">Records</span></div>
            <p class="text-[11px] text-slate-400 mt-2">Total shifts captured in period</p>
        </div>
    </div>

    {{-- Filters Card --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 mb-6 shadow-2xs">
        <form method="GET" action="{{ route('attendance.history') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3 items-end">
            <div>
                <label for="month" class="block text-[11px] font-semibold text-slate-600 mb-1">Month</label>
                <select name="month" id="month" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ sprintf('%02d', $m) }}" {{ (int) $currentMonth === $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="year" class="block text-[11px] font-semibold text-slate-600 mb-1">Year</label>
                <select name="year" id="year" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    @for ($y = date('Y'); $y >= date('Y') - 2; $y--)
                        <option value="{{ $y }}" {{ (int) $currentYear === $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="status" class="block text-[11px] font-semibold text-slate-600 mb-1">Status</label>
                <select name="status" id="status" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    <option value="">All statuses</option>
                    <option value="present" {{ $currentStatus === 'present' ? 'selected' : '' }}>Present</option>
                    <option value="late" {{ $currentStatus === 'late' ? 'selected' : '' }}>Late</option>
                    <option value="leave" {{ $currentStatus === 'leave' ? 'selected' : '' }}>Leave</option>
                    <option value="sick" {{ $currentStatus === 'sick' ? 'selected' : '' }}>Sick</option>
                    <option value="permission" {{ $currentStatus === 'permission' ? 'selected' : '' }}>Permission</option>
                    <option value="absent" {{ $currentStatus === 'absent' ? 'selected' : '' }}>Absent</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="w-full py-1.5 px-3 bg-[#0F766E] hover:bg-teal-800 text-white rounded-lg text-xs font-semibold shadow-2xs transition cursor-pointer">
                    Apply Filter
                </button>
                <a href="{{ route('attendance.history') }}" class="py-1.5 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-medium text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Attendance Table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3.5">Date</th>
                        <th class="px-6 py-3.5">Shift</th>
                        <th class="px-6 py-3.5">Check-in</th>
                        <th class="px-6 py-3.5">Check-out</th>
                        <th class="px-6 py-3.5">Late (mins)</th>
                        <th class="px-6 py-3.5">Attendance</th>
                        <th class="px-6 py-3.5">Review Status</th>
                        <th class="px-6 py-3.5">Review Note</th>
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
                                'leave', 'cuti', 'permission', 'izin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'sick', 'sakit' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                default => 'bg-rose-50 text-rose-700 border-rose-200',
                            };

                            $reviewBadge = match (strtolower($reviewVal)) {
                                'approved', 'disetujui' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'rejected', 'ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                                default => 'bg-amber-50 text-amber-700 border-amber-200',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-3.5 font-medium text-slate-800">
                                {{ $att->attendance_date ? \Carbon\Carbon::parse($att->attendance_date)->translatedFormat('D, M d, Y') : '-' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-500">
                                {{ $att->workShift?->name ?? 'Standard' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-700 font-mono">
                                {{ $att->check_in_time ? \Carbon\Carbon::parse($att->check_in_time)->format('H:i') : '-' }}
                            </td>
                            <td class="px-6 py-3.5 text-slate-700 font-mono">
                                {{ $att->check_out_time ? \Carbon\Carbon::parse($att->check_out_time)->format('H:i') : '-' }}
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
                            <td class="px-6 py-3.5 text-slate-500 max-w-xs truncate">
                                {{ $att->review_note ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-xs text-slate-400">
                                Tidak ada data presensi yang sesuai dengan filter yang dipilih.
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
