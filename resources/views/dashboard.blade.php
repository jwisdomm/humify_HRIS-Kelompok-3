<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-slate-50">

    {{-- Sidebar --}}
    @include('components.sidebar', ['active' => 'My Dashboard'])

    {{-- Main Wrapper --}}
    <div class="flex flex-col flex-1 ml-48">

        {{-- Top Header Bar --}}
        @include('components.navbar', ['page' => 'My Dashboard'])

        {{-- Page Content --}}
        <main class="flex-1 px-8 py-8">

            {{-- Page Title --}}
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-slate-800">Good morning, Alex</h1>
                <p class="text-xs text-slate-400 mt-1">Your workday, at a glance. &middot; Friday, October 23, 2026</p>
            </div>

            {{-- Employee Info Card --}}
            <div class="bg-white border border-slate-200 rounded-lg px-6 py-4 mb-4 grid grid-cols-4 gap-4">
                <div>
                    <p class="text-xs text-slate-400 mb-0.5">Alex Morgan &middot; EMP-001</p>
                    <p class="text-sm font-semibold text-slate-800">Product Designer</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 mb-0.5">Department</p>
                    <p class="text-sm font-semibold text-slate-800">Product Design</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 mb-0.5">Direct manager</p>
                    <p class="text-sm font-semibold text-slate-800">Maya Chen</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 mb-0.5">Employment</p>
                    <p class="text-sm font-semibold text-slate-800">Active &middot; Regular</p>
                </div>
            </div>

            {{-- Leave Stats Cards --}}
            <div class="grid grid-cols-3 gap-4 mb-6">

                {{-- Annual Leave --}}
                <x-card title="Annual leave · remaining" value="8 Days">
                    2026 &middot; 12 opening / 4 used
                </x-card>

                {{-- Personal Leave --}}
                <x-card title="Personal leave · remaining" value="2 Days">2026 &middot; 3 opening / 1 used</x-card>

             
                <x-card title="Requests awaiting a decision" value="1">
                    <a class="hover:underline" href="#">View Leave &amp; Requests &rarr;</a>
                </x-card>

            </div>

            {{-- Recent Attendance --}}
            <x-table
                title="Recent attendance"
                subtitle="Your records only &middot; October 2026"
                link="#"
                link-label="Attendance History"
                :columns="['Date', 'Shift', 'Check-in', 'Check-out', 'Attendance', 'Review status']"
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
                </tr>
            </x-table>

            {{-- Latest Requests --}}
            <x-table
                title="Latest requests"
                link="#"
                link-label="Leave &amp; Requests"
                :columns="['Type', 'Dates', 'Submitted via', 'Status', 'Decision notes']"
            >
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Annual leave</td>
                    <td class="px-6 py-3 text-slate-500">Nov 2–3, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Mobile app</td>
                    <td class="px-6 py-3">
                        <span class="text-amber-500 font-medium">Pending Approval</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Awaiting Maya Chen</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Annual leave</td>
                    <td class="px-6 py-3 text-slate-500">Oct 12–13, 2026</td>
                    <td class="px-6 py-3 text-slate-500">Mobile app</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Approved by Maya Chen</td>
                </tr>
            </x-table>

            {{-- Bottom Info Banner --}}
            <x-info-banner>
                Use the Humify mobile app to record attendance or submit a request.
                <span class="text-slate-500">This portal is read-only for attendance and requests.</span>
            </x-info-banner>

        </main>
    </div>

</body>

</html>