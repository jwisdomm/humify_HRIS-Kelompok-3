<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-slate-50">

    {{-- Sidebar / Navbar --}}
    @include('components.navbar')

    {{-- Main Wrapper --}}
    <div class="flex flex-col flex-1 ml-48">

        {{-- Top Header Bar --}}
        <header class="h-12 flex items-center justify-between px-6 bg-white border-b border-slate-200">
            <nav class="flex items-center gap-1 text-xs text-slate-400">
                <span>Workspace</span>
                <span>/</span>
                <span class="text-slate-600 font-medium">My Dashboard</span>
            </nav>
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-400">Employee</span>
                <span class="text-xs font-semibold text-slate-700">Alex Morgan</span>
            </div>
        </header>

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
                <div class="bg-white border border-slate-200 rounded-lg px-6 py-5">
                    <p class="text-xs text-slate-400 mb-2">Annual leave &middot; remaining</p>
                    <p class="text-3xl font-bold text-slate-800 mb-2">8 days</p>
                    <p class="text-xs text-teal-600">2026 &middot; 12 opening / 4 used</p>
                </div>

                {{-- Personal Leave --}}
                <div class="bg-white border border-slate-200 rounded-lg px-6 py-5">
                    <p class="text-xs text-slate-400 mb-2">Personal leave &middot; remaining</p>
                    <p class="text-3xl font-bold text-slate-800 mb-2">2 days</p>
                    <p class="text-xs text-teal-600">2026 &middot; 3 opening / 1 used</p>
                </div>

                {{-- Requests Awaiting --}}
                <div class="bg-white border border-slate-200 rounded-lg px-6 py-5">
                    <p class="text-xs text-slate-400 mb-2">Requests awaiting a decision</p>
                    <p class="text-3xl font-bold text-slate-800 mb-2">1</p>
                    <a href="#" class="text-xs text-teal-600 hover:underline">View Leave &amp; Requests &rarr;</a>
                </div>

            </div>

            {{-- Recent Attendance --}}
            <div class="bg-white border border-slate-200 rounded-lg mb-4">
                <div class="flex items-start justify-between px-6 pt-5 pb-4 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Recent attendance</p>
                        <p class="text-xs text-slate-400 mt-0.5">Your records only &middot; October 2026</p>
                    </div>
                    <a href="#" class="text-xs text-teal-600 hover:underline whitespace-nowrap">Attendance History &rarr;</a>
                </div>

                <table class="w-full text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100">
                            <th class="px-6 py-3 text-left font-medium">Date</th>
                            <th class="px-6 py-3 text-left font-medium">Shift</th>
                            <th class="px-6 py-3 text-left font-medium">Check-in</th>
                            <th class="px-6 py-3 text-left font-medium">Check-out</th>
                            <th class="px-6 py-3 text-left font-medium">Attendance</th>
                            <th class="px-6 py-3 text-left font-medium">Review status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
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
                    </tbody>
                </table>
            </div>

            {{-- Latest Requests --}}
            <div class="bg-white border border-slate-200 rounded-lg mb-4">
                <div class="flex items-start justify-between px-6 pt-5 pb-4 border-b border-slate-100">
                    <p class="text-sm font-semibold text-slate-800">Latest requests</p>
                    <a href="#" class="text-xs text-teal-600 hover:underline whitespace-nowrap">Leave &amp; Requests &rarr;</a>
                </div>

                <table class="w-full text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100">
                            <th class="px-6 py-3 text-left font-medium">Type</th>
                            <th class="px-6 py-3 text-left font-medium">Dates</th>
                            <th class="px-6 py-3 text-left font-medium">Submitted via</th>
                            <th class="px-6 py-3 text-left font-medium">Status</th>
                            <th class="px-6 py-3 text-left font-medium">Decision notes</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
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
                    </tbody>
                </table>
            </div>

            {{-- Bottom Info Banner --}}
            <div class="bg-teal-50 border border-teal-100 rounded-lg px-6 py-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <p class="text-xs text-teal-700">
                    Use the Humify mobile app to record attendance or submit a request.
                    <span class="text-slate-500">This portal is read-only for attendance and requests.</span>
                </p>
            </div>

        </main>
    </div>

</body>

</html>