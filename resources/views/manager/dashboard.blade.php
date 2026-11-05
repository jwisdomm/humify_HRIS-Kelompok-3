@extends('layouts.app', [
    'title' => 'Manager Dashboard',
    'active' => 'Dashboard',
    'pageTitle' => 'Manager Dashboard'
])

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Good morning, {{ $employee?->full_name ? explode(' ', $employee->full_name)[0] : $user->username }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Manager Workspace &middot; Direct reports overview &middot; {{ now()->translatedFormat('l, F j, Y') }}
            </p>
        </div>

        <span class="px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg text-xs font-semibold">
            Team Manager Scope
        </span>
    </div>

    {{-- Metrics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        {{-- Card 1: Pending Attendance Reviews --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs flex flex-col justify-between">
            <div>
                <span class="text-xs font-medium text-slate-500">Pending attendance reviews</span>
                <div class="text-3xl font-bold text-slate-900 mt-2">{{ $pendingReviewsCount }}</div>
                <p class="text-xs text-slate-400 mt-1">Direct reports waiting for verification</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100">
                <a href="{{ route('manager.attendance-reviews') }}" class="text-xs font-semibold text-[#0F766E] hover:underline flex items-center gap-1">
                    <span>Review attendance queue</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Card 2: Pending Leave Requests --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs flex flex-col justify-between">
            <div>
                <span class="text-xs font-medium text-slate-500">Pending leave approvals</span>
                <div class="text-3xl font-bold text-slate-900 mt-2">{{ $pendingRequestsCount }}</div>
                <p class="text-xs text-slate-400 mt-1">Leave/sick/permission awaiting your approval</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100">
                <a href="{{ route('manager.leave-approvals') }}" class="text-xs font-semibold text-[#0F766E] hover:underline flex items-center gap-1">
                    <span>Process approvals queue</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Card 3: Team Presence Today --}}
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-2xs flex flex-col justify-between">
            <div>
                <span class="text-xs font-medium text-slate-500">Team present today</span>
                <div class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $teamPresentTodayCount }} <span class="text-base font-normal text-slate-400">/ {{ $teamMembersCount }}</span>
                </div>
                <p class="text-xs text-slate-400 mt-1">Direct reports checked in today</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100">
                <a href="{{ route('manager.team-history') }}" class="text-xs font-semibold text-[#0F766E] hover:underline flex items-center gap-1">
                    <span>View team history</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- 2 Action Queue Tables --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Queue 1: Attendance Review --}}
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900">Attendance Reviews Awaiting Action</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Bawahan langsung Anda</p>
                </div>
                <a href="{{ route('manager.attendance-reviews') }}" class="text-xs text-[#0F766E] hover:underline font-medium">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3">Employee</th>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3">Check-in</th>
                            <th class="px-5 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($pendingReviews as $rev)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3 font-medium text-slate-800">
                                    {{ $rev->employee?->full_name }}
                                </td>
                                <td class="px-5 py-3 text-slate-500">
                                    {{ \Carbon\Carbon::parse($rev->attendance_date)->format('M d') }}
                                </td>
                                <td class="px-5 py-3 font-mono text-slate-700">
                                    {{ $rev->check_in_time ? \Carbon\Carbon::parse($rev->check_in_time)->format('H:i') : '-' }}
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('manager.attendance-reviews', ['search' => $rev->employee?->full_name]) }}" class="px-2.5 py-1 bg-teal-50 text-teal-700 hover:bg-teal-100 rounded text-[11px] font-semibold">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-xs text-slate-400">
                                    Tidak ada presensi yang menunggu review saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Queue 2: Leave Approvals --}}
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900">Leave Requests Awaiting Decision</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Permohonan bawahan langsung</p>
                </div>
                <a href="{{ route('manager.leave-approvals') }}" class="text-xs text-[#0F766E] hover:underline font-medium">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3">Employee</th>
                            <th class="px-5 py-3">Type</th>
                            <th class="px-5 py-3">Days</th>
                            <th class="px-5 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($pendingRequests as $req)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3 font-medium text-slate-800">
                                    {{ $req->employee?->full_name }}
                                </td>
                                <td class="px-5 py-3 text-slate-500">
                                    {{ $req->leaveType?->name }}
                                </td>
                                <td class="px-5 py-3 font-semibold text-slate-700">
                                    {{ $req->total_days }}d
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('manager.leave-approvals', ['search' => $req->employee?->full_name]) }}" class="px-2.5 py-1 bg-amber-50 text-amber-700 hover:bg-amber-100 rounded text-[11px] font-semibold">
                                        Decide
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-xs text-slate-400">
                                    Tidak ada pengajuan cuti yang menunggu keputusan saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

