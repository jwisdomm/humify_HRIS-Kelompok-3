@extends('layouts.app', [
    'title' => 'Monthly Report',
    'active' => 'Monthly Report',
    'pageTitle' => 'Monthly Attendance Report'
])

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Monthly attendance report</h1>
            <p class="text-xs text-slate-500 mt-1">
                Aggregated monthly attendance, lateness, and leave metrics per employee
            </p>
        </div>

        <span class="px-3 py-1 bg-teal-50 text-teal-700 border border-teal-200 rounded-lg text-xs font-semibold">
            Period: {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}
        </span>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 mb-6 shadow-2xs">
        <form method="GET" action="{{ route('hr.reports') }}" class="grid grid-cols-1 sm:grid-cols-5 gap-3 items-end">
            <div>
                <label for="month" class="block text-[11px] font-semibold text-slate-600 mb-1">Month</label>
                <select name="month" id="month" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ (int) $month === $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="year" class="block text-[11px] font-semibold text-slate-600 mb-1">Year</label>
                <select name="year" id="year" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    @for ($y = date('Y'); $y >= date('Y') - 3; $y--)
                        <option value="{{ $y }}" {{ (int) $year === $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="department_id" class="block text-[11px] font-semibold text-slate-600 mb-1">Department</label>
                <select name="department_id" id="department_id" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    <option value="">All Departments</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" {{ (string) $departmentId === (string) $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="employee_id" class="block text-[11px] font-semibold text-slate-600 mb-1">Employee</label>
                <select name="employee_id" id="employee_id" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600">
                    <option value="">All Employees</option>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}" {{ $employeeId === $emp->id ? 'selected' : '' }}>
                            {{ $emp->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="w-full py-1.5 px-3 bg-[#0F766E] hover:bg-teal-800 text-white rounded-lg text-xs font-semibold shadow-2xs transition cursor-pointer">
                    Filter
                </button>
                <a href="{{ route('hr.reports') }}" class="py-1.5 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-medium text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Aggregate Summary Metric Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3 mb-6">
        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-emerald-700">Present (Hadir)</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['present'] }}</div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-amber-700">Late (Terlambat)</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['late'] }}</div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-orange-700">Late Minutes</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['late_minutes'] }} <span class="text-xs font-normal">m</span></div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-blue-700">Permission (Izin)</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['permission'] }}</div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-indigo-700">Sick (Sakit)</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['sick'] }}</div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-teal-700">Leave (Cuti)</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['leave'] }}</div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-2xs">
            <span class="text-[11px] font-semibold text-rose-700">Absent (Alpha)</span>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $totals['alpha'] }}</div>
        </div>
    </div>

    {{-- Report Table --}}
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3.5">Employee</th>
                        <th class="px-6 py-3.5">Department</th>
                        <th class="px-6 py-3.5 text-center text-emerald-700">Hadir</th>
                        <th class="px-6 py-3.5 text-center text-amber-700">Terlambat</th>
                        <th class="px-6 py-3.5 text-center text-orange-700">Menit Terlambat</th>
                        <th class="px-6 py-3.5 text-center text-blue-700">Izin</th>
                        <th class="px-6 py-3.5 text-center text-indigo-700">Sakit</th>
                        <th class="px-6 py-3.5 text-center text-teal-700">Cuti</th>
                        <th class="px-6 py-3.5 text-center text-rose-700">Alpha</th>
                        <th class="px-6 py-3.5 text-right">Total Logs</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($reportData as $row)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-3.5">
                                <div class="font-medium text-slate-900">{{ $row['employee']->full_name }}</div>
                                <div class="text-[10px] text-slate-400">{{ $row['employee']->employee_code }}</div>
                            </td>
                            <td class="px-6 py-3.5 text-slate-600">
                                {{ $row['employee']->department?->name ?? '-' }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold text-slate-800">
                                {{ $row['present'] }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold {{ $row['late'] > 0 ? 'text-amber-700' : 'text-slate-400' }}">
                                {{ $row['late'] }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold {{ $row['late_minutes'] > 0 ? 'text-orange-700' : 'text-slate-400' }}">
                                {{ $row['late_minutes'] > 0 ? $row['late_minutes'] . ' m' : '-' }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold {{ $row['permission'] > 0 ? 'text-blue-700' : 'text-slate-400' }}">
                                {{ $row['permission'] }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold {{ $row['sick'] > 0 ? 'text-indigo-700' : 'text-slate-400' }}">
                                {{ $row['sick'] }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold {{ $row['leave'] > 0 ? 'text-teal-700' : 'text-slate-400' }}">
                                {{ $row['leave'] }}
                            </td>
                            <td class="px-6 py-3.5 text-center font-semibold {{ $row['alpha'] > 0 ? 'text-rose-700' : 'text-slate-400' }}">
                                {{ $row['alpha'] }}
                            </td>
                            <td class="px-6 py-3.5 text-right font-mono font-semibold text-slate-800">
                                {{ $row['total_records'] }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-10 text-center text-xs text-slate-400">
                                Tidak ada data rekap presensi untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

