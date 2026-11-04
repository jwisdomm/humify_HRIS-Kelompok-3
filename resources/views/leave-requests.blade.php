<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave &amp; Requests</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-slate-50">

    {{-- Sidebar --}}
    @include('components.sidebar', ['active' => 'Leave & Requests'])

    {{-- Main Wrapper --}}
    <div class="flex flex-col flex-1 ml-48">

        {{-- Top Header Bar --}}
        @include('components.navbar', ['page' => 'Leave & Requests'])

        {{-- Page Content --}}
        <main class="flex-1 px-8 py-8">

            {{-- Page Title --}}
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-slate-800">My leave &amp; requests</h1>
                <p class="text-xs text-slate-400 mt-1">Your balances and requests submitted through the Humify mobile app.</p>
            </div>

            {{-- Leave Balance Cards --}}
            <div class="grid grid-cols-3 gap-4 mb-6">
                <x-card title="Annual leave" value="8 days">
                    2026 &middot; Opening 12 / Used 4
                </x-card>
                <x-card title="Personal leave" value="2 days">
                    2026 &middot; Opening 3 / Used 1
                </x-card>
                <x-card title="Pending approval" value="1 request">
                    Pending requests do not change this balance
                </x-card>
            </div>

            {{-- Filter Bar --}}
            <div class="flex items-end gap-3 mb-6">
                <div class="w-64">
                    <x-input name="search" placeholder="Search requests...">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </x-slot:icon>
                    </x-input>
                </div>
                <div class="w-32">
                    <x-select
                        name="year"
                        value="2026"
                        :options="[
                            '2026' => '2026',
                            '2025' => '2025',
                            '2024' => '2024',
                        ]"
                    />
                </div>
                <div class="w-44">
                    <x-select
                        name="type"
                        placeholder="All types"
                        :options="[
                            'annual' => 'Annual leave',
                            'personal' => 'Personal leave',
                            'sick' => 'Sick',
                            'permission' => 'Permission',
                        ]"
                    />
                </div>
                <div class="w-44">
                    <x-select
                        name="status"
                        placeholder="All statuses"
                        :options="[
                            'pending' => 'Pending Approval',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'cancelled' => 'Cancelled',
                        ]"
                    />
                </div>
                <div class="flex justify-center items-center border border-black">
                    <x-button variant="link">Reset</x-button>
                </div>
            </div>

            {{-- Request History Table --}}
            <x-table
                title="Request history"
                subtitle="Your requests only &middot; Decisions are read-only on the web"
                :columns="['Type', 'Dates', 'Duration', 'Status', 'Decision notes']"
            >
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Annual leave</td>
                    <td class="px-6 py-3 text-slate-500">Nov 2&ndash;3, 2026</td>
                    <td class="px-6 py-3 text-slate-500">2 days</td>
                    <td class="px-6 py-3">
                        <span class="text-amber-500 font-medium">Pending Approval</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Awaiting Maya Chen</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Annual leave</td>
                    <td class="px-6 py-3 text-slate-500">Oct 12&ndash;13, 2026</td>
                    <td class="px-6 py-3 text-slate-500">2 days</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Maya Chen &middot; Enjoy your time off.</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Personal leave</td>
                    <td class="px-6 py-3 text-slate-500">Sep 18, 2026</td>
                    <td class="px-6 py-3 text-slate-500">1 day</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Maya Chen &middot; Approved.</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3">
                        <span class="inline-block rounded bg-teal-50 px-2 py-0.5 text-teal-700 font-medium">Sick</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Sep 7, 2026</td>
                    <td class="px-6 py-3 text-slate-500">1 day</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Maya Chen &middot; Get well soon.</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Annual leave</td>
                    <td class="px-6 py-3 text-slate-500">Aug 21, 2026</td>
                    <td class="px-6 py-3 text-slate-500">1 day</td>
                    <td class="px-6 py-3">
                        <span class="text-red-500 font-medium">Rejected</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Team coverage needed. Choose another date.</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3">
                        <span class="inline-block rounded bg-teal-50 px-2 py-0.5 text-teal-700 font-medium">Permission</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Aug 14, 2026</td>
                    <td class="px-6 py-3 text-slate-500">2 hours</td>
                    <td class="px-6 py-3">
                        <span class="text-slate-400 font-medium">Cancelled</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Cancelled by you in the mobile app.</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-3 font-semibold text-slate-700">Annual leave</td>
                    <td class="px-6 py-3 text-slate-500">Jul 6&ndash;7, 2026</td>
                    <td class="px-6 py-3 text-slate-500">2 days</td>
                    <td class="px-6 py-3">
                        <span class="text-teal-600 font-medium">Approved</span>
                    </td>
                    <td class="px-6 py-3 text-slate-500">Maya Chen &middot; Approved.</td>
                </tr>

                {{-- Footer / Pagination --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400">Showing 1&ndash;7 of 7 records</span>
                        <div class="flex items-center gap-2">
                            <span class="text-slate-300">Previous</span>
                            <span class="text-slate-300">&middot;</span>
                            <span class="text-teal-700 font-semibold">1</span>
                            <span class="text-slate-300">&middot;</span>
                            <span class="text-slate-300">Next</span>
                        </div>
                    </div>
                </x-slot:footer>
            </x-table>

            {{-- Bottom Info Banner --}}
            <x-info-banner>
                Create or cancel eligible requests in the mobile app. <span class="text-slate-500">Web requests and attachments are read-only.</span>
            </x-info-banner>

        </main>
    </div>

</body>

</html>

