@extends('layouts.app', [
    'title' => 'Dashboard',
    'active' => 'My Dashboard',
    'pageTitle' => 'My Dashboard'
])

@section('content')
    {{-- Page Title --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Good morning, {{ $employee?->full_name ? explode(' ', $employee->full_name)[0] : $user->username }}</h1>
        <p class="text-xs text-slate-500 mt-1">Your workday, at a glance &middot; {{ now()->translatedFormat('l, F j, Y') }}</p>
    </div>

    {{-- Employee Organization Summary Card --}}
    <div class="bg-white border border-slate-200 rounded-xl px-6 py-4.5 mb-6 shadow-2xs grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <p class="text-[11px] font-medium text-slate-400 mb-0.5">{{ $employee?->full_name ?? $user->username }} &middot; {{ $employee?->employee_code ?? '-' }}</p>
            <p class="text-sm font-semibold text-slate-800">{{ $employee?->position?->name ?? 'Staff' }}</p>
        </div>
        <div>
            <p class="text-[11px] font-medium text-slate-400 mb-0.5">Department</p>
            <p class="text-sm font-semibold text-slate-800">{{ $employee?->department?->name ?? 'General' }}</p>
        </div>
        <div>
            <p class="text-[11px] font-medium text-slate-400 mb-0.5">Direct manager</p>
            <p class="text-sm font-semibold text-slate-800">{{ $employee?->supervisor?->full_name ?? 'Not assigned' }}</p>
        </div>
        <div>
            <p class="text-[11px] font-medium text-slate-400 mb-0.5">Employment</p>
            <p class="text-sm font-semibold text-slate-800">
                <span class="inline-flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    {{ ucfirst($employee?->employee_status?->value ?? (string) $employee?->employee_status ?? 'Active') }} &middot; {{ $employee?->is_shift_worker ? 'Shifting' : 'Regular' }}
                </span>
            </p>
        </div>
    </div>

    {{-- Mobile Channel Notice Banner --}}
    <div class="mb-6 p-4 rounded-xl bg-teal-50/70 border border-teal-200/80 flex items-start gap-3.5 shadow-2xs">
        <div class="w-8 h-8 rounded-lg bg-teal-600/10 text-[#0F766E] flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-xs font-semibold text-teal-900">Aplikasi Mobile untuk Presensi & Pengajuan</h4>
            <p class="text-xs text-teal-700/90 mt-0.5 leading-relaxed">
                Check-in, check-out, serta pengajuan cuti, izin, atau sakit dilakukan melalui <strong>aplikasi mobile Humify</strong>. Portal web ini menyediakan informasi riwayat dan pengelolaan profil personal.
            </p>
        </div>
    </div>

    {{-- Leave Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @php
            $annualLeave = $leaveBalances->first(fn($b) => str_contains(strtolower($b->leaveType?->name ?? ''), 'annual'));
            $personalLeave = $leaveBalances->first(fn($b) => str_contains(strtolower($b->leaveType?->name ?? ''), 'personal'));
            $annualRemaining = $annualLeave ? ($annualLeave->total_days - $annualLeave->used_days) : 0;
            $personalRemaining = $personalLeave ? ($personalLeave->total_days - $personalLeave->used_days) : 0;
        @endphp

        {{-- Annual Leave Card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs">
            <span class="text-xs font-medium text-slate-500">Annual leave &middot; remaining</span>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $annualRemaining }} <span class="text-sm font-normal text-slate-500">Days</span></div>
            <p class="text-xs text-slate-400 mt-2">
                {{ date('Y') }} &middot; {{ $annualLeave?->total_days ?? 0 }} opening / {{ $annualLeave?->used_days ?? 0 }} used
            </p>
        </div>

        {{-- Personal Leave Card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs">
            <span class="text-xs font-medium text-slate-500">Personal leave &middot; remaining</span>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $personalRemaining }} <span class="text-sm font-normal text-slate-500">Days</span></div>
            <p class="text-xs text-slate-400 mt-2">
                {{ date('Y') }} &middot; {{ $personalLeave?->total_days ?? 0 }} opening / {{ $personalLeave?->used_days ?? 0 }} used
            </p>
        </div>

        {{-- Requests Pending Card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs flex flex-col justify-between">
            <div>
                <span class="text-xs font-medium text-slate-500">Requests awaiting a decision</span>
                <div class="text-2xl font-bold text-slate-900 mt-2">{{ $pendingRequestsCount }}</div>
            </div>
            <div class="mt-2">
                <a href="{{ route('leave.requests') }}" class="text-xs font-medium text-[#0F766E] hover:underline flex items-center gap-1">
                    <span>View Leave &amp; Requests</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Recent Attendance Table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-slate-900">Recent attendance</h3>
                <p class="text-xs text-slate-400 mt-0.5">Your records only &middot; {{ now()->translatedFormat('F Y') }}</p>
            </div>
            <a href="{{ route('attendance.history') }}" class="text-xs font-medium text-[#0F766E] hover:underline flex items-center gap-1">
                <span>Attendance History</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Shift</th>
                        <th class="px-6 py-3">Check-in</th>
                        <th class="px-6 py-3">Check-out</th>
                        <th class="px-6 py-3">Attendance</th>
                        <th class="px-6 py-3">Review status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($recentAttendances as $att)
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
                                {{ $att->attendance_date ? \Carbon\Carbon::parse($att->attendance_date)->translatedFormat('M d, Y') : '-' }}
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
                            <td colspan="6" class="px-6 py-8 text-center text-xs text-slate-400">
                                Belum ada riwayat presensi tercatat untuk bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
