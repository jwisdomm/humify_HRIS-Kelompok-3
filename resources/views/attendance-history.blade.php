<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance History</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-slate-50">

    {{-- Sidebar --}}
    @include('components.sidebar', ['active' => 'Attendance History'])

    {{-- Main Wrapper --}}
    <div class="flex flex-col flex-1 ml-48">

        {{-- Top Header Bar --}}
        @include('components.navbar', ['page' => 'Attendance History'])

        {{-- Page Content --}}
        <main class="flex-1 px-8 py-8">

            {{-- Page Title --}}
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-slate-800">My attendance history</h1>
                <p class="text-xs text-slate-400 mt-1">Your attendance records and review outcomes. All times are recorded timestamps.</p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-3 gap-4 mb-6">
                <x-card title="Present" value="15 days">
                    Includes 2 days marked Late
                </x-card>
                <x-card title="Leave" value="2 days">
                    Approved annual leave
                </x-card>
                <x-card title="Awaiting review" value="1 record">
                    October 2026 &middot; Your records only
                </x-card>
            </div>

            {{-- Filter Bar --}}
            <div class="flex items-end gap-3 mb-6">
                <div class="w-64">
                    <x-input name="search" placeholder="Search records...">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </x-slot:icon>
                    </x-input>
                </div>
                <div class="w-44">
                    <x-select
                        name="month"
                        value="2026-10"
                        :options="[
                            '2026-10' => 'October 2026',
                            '2026-09' => 'September 2026',
                            '2026-08' => 'August 2026',
                        ]"
                    />
                </div>
                <div class="w-44">
                    <x-select
                        name="status"
                        placeholder="All statuses"
                        :options="[
                            'present' => 'Present',
                            'late' => 'Late',
                            'leave' => 'Leave',
                            'absent' => 'Absent',
                        ]"
                    />
                </div>
                <x-button variant="link">Reset</x-button>
            </div>

            {{-- Attendance Table --}}
            <x-table
                title="October attendance"
                subtitle="Alex Morgan &middot; EMP-001"
                :columns="['Date', 'Shift', 'Check-in', 'Check-out', 'Attendance', 'Review status', 'Reviewer notes']"
            >
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Oct 23, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Not configured</td>
                    <td class="px-6 py-3 text-slate-700">08:57</td>
                    <td class="px-6 py-3 text-slate-700">18:02</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Present</span>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-amber-500 font-medium">Pending Review</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Awaiting review</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Oct 22, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Not configured</td>
                    <td class="px-6 py-3 text-slate-700">08:55</td>
                    <td class="px-6 py-3 text-slate-700">18:01</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Present</span>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Verified &middot; Maya Chen</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Oct 21, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Not configured</td>
                    <td class="px-6 py-3 text-slate-700">09:12</td>
                    <td class="px-6 py-3 text-slate-700">18:10</td>
                    <td class="px-6 py-3">
                        <span class="text-amber-500 font-medium">Late</span>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Reviewed &middot; Maya Chen</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Oct 20, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Not configured</td>
                    <td class="px-6 py-3 text-slate-700">08:58</td>
                    <td class="px-6 py-3 text-slate-700">18:00</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Present</span>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Verified &middot; Maya Chen</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Oct 19, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Not configured</td>
                    <td class="px-6 py-3 text-slate-700">08:51</td>
                    <td class="px-6 py-3 text-slate-700">18:02</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Present</span>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Verified &middot; Maya Chen</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Oct 16, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Not configured</td>
                    <td class="px-6 py-3 text-slate-700">08:54</td>
                    <td class="px-6 py-3 text-slate-700">18:04</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Present</span>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Verified &middot; Maya Chen</td>
                </tr>

                {{-- Footer / Pagination --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400">Showing 1&ndash;6 of 17 records</span>
                        <div class="flex items-center gap-2">
                            <a href="#" class="text-slate-400 hover:text-slate-600">Previous</a>
                            <span class="text-slate-300">&middot;</span>
                            <span class="text-teal-700 font-semibold">1</span>
                            <span class="text-slate-300">&middot;</span>
                            <a href="#" class="text-slate-400 hover:text-slate-600">Next</a>
                        </div>
                    </div>
                </x-slot:footer>
            </x-table>

            {{-- Bottom Info Banner --}}
            <x-info-banner>
                Attendance is read-only on the web. Use the Humify mobile app to record attendance.
            </x-info-banner>

        </main>
    </div>

</body>

</html>

