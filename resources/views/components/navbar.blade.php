<aside
    class="py-7 flex flex-col justify-between fixed top-0 left-0 z-40 w-48 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-slate-200"
    aria-label="Sidebar">
    <div class="flex flex-col gap-6">
        <div class="w-full">
            <img class="w-30 cursor-pointer px-1" src="img/logo-with-name.png" alt="">
        </div>
        <span class="text-slate-500 px-4 text-xs">Employee workspace</span>
        <nav class="mt-4 border-t border-slate-200 pt-2">
            <ul class="flex flex-col gap-1">
                <li
                    class="px-4 h-8 text-xs text-teal-700 bg-teal-50 cursor-pointer flex items-center font-medium">
                    My Dashboard
                </li>
                <li
                    class="px-4 h-8 text-xs text-slate-500 hover:text-teal-700 hover:bg-teal-50 cursor-pointer flex items-center">
                    My Profile
                </li>
                <li
                    class="px-4 h-8 text-xs text-slate-500 hover:text-teal-700 hover:bg-teal-50 cursor-pointer flex items-center">
                    Attendance History
                </li>
                <li
                    class="px-4 h-8 text-xs text-slate-500 hover:text-teal-700 hover:bg-teal-50 cursor-pointer flex items-center">
                    Leave & Requests
                </li>
            </ul>
        </nav>
    </div>

    {{-- Bottom section --}}
    <div class="px-4 flex flex-col gap-4">
        <p class="text-xs text-slate-400 leading-relaxed">
            Use the Humify mobile app to record attendance or submit a request.
        </p>
        <a href="#" class="text-xs text-slate-500 hover:text-slate-700 flex items-center gap-1">
            Sign out
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
        </a>
    </div>

</aside>