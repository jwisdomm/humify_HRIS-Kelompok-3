<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-slate-50">

    {{-- Sidebar --}}
    @include('components.sidebar', ['active' => 'My Profile'])

    {{-- Main Wrapper --}}
    <div class="flex flex-col flex-1 ml-48">

        {{-- Top Header Bar --}}
        @include('components.navbar', ['page' => 'My Profile'])

        {{-- Page Content --}}
        <main class="flex-1 px-8 py-8">

            {{-- Page Title Row --}}
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-800">My profile</h1>
                    <p class="text-xs text-slate-400 mt-1">Keep your personal contact details up to date.</p>
                </div>
                <x-button variant="secondary">Cancel edit</x-button>
            </div>

            {{-- Two-Column Layout --}}
            <div class="grid grid-cols-3 gap-6 mb-6">

                {{-- Left: Personal Information (2/3 width) --}}
                <div class="col-span-2 bg-white border border-slate-200 rounded-lg px-6 py-5">
                    <p class="text-base font-semibold text-slate-800">Personal information</p>
                    <p class="text-xs text-slate-400 mt-0.5 mb-6">Editing your contact details</p>

                    <form class="flex flex-col gap-5">
                        {{-- Legal Name (read-only) --}}
                        <x-input
                            label="Legal name · Read-only"
                            name="legal_name"
                            value="Alex Morgan"
                            :readonly="true"
                        />

                        {{-- Phone & Personal Email --}}
                        <div class="grid grid-cols-2 gap-4">
                            <x-input
                                label="Phone"
                                name="phone"
                                type="tel"
                                value="+1 202 555 0142"
                            />
                            <x-input
                                label="Personal email"
                                name="personal_email"
                                type="email"
                                value="alex.morgan@example.com"
                            />
                        </div>

                        {{-- Home Address --}}
                        <x-textarea
                            label="Home address"
                            name="home_address"
                            value="24 Willow Lane, Austin, TX 78701"
                            :rows="3"
                        />

                        {{-- Emergency Contact --}}
                        <div class="grid grid-cols-2 gap-4">
                            <x-input
                                label="Emergency contact name"
                                name="emergency_contact_name"
                                value="Taylor Morgan · Partner"
                            />
                            <x-input
                                label="Emergency contact phone"
                                name="emergency_contact_phone"
                                type="tel"
                                value="+1 202 555 0178"
                            />
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-3 pt-2">
                            <x-button type="submit">Save Changes</x-button>
                            <x-button variant="secondary">Cancel edit</x-button>
                        </div>
                    </form>
                </div>

                {{-- Right: Employment Details (1/3 width) --}}
                <div class="bg-white border border-slate-200 rounded-lg px-6 py-5">
                    <p class="text-base font-semibold text-slate-800">Employment details</p>
                    <p class="text-xs text-slate-400 mt-0.5 mb-6">Managed by HR &middot; Read-only</p>

                    <div class="flex flex-col gap-5">
                        {{-- Employee ID & Department --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Employee ID</p>
                                <p class="text-sm font-semibold text-slate-800">EMP-001</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Department</p>
                                <p class="text-sm font-semibold text-slate-800">Product Design</p>
                            </div>
                        </div>

                        {{-- Job Title --}}
                        <div>
                            <p class="text-xs text-slate-400 mb-0.5">Job title</p>
                            <p class="text-sm font-semibold text-slate-800">Product Designer</p>
                        </div>

                        {{-- Direct Manager --}}
                        <div>
                            <p class="text-xs text-slate-400 mb-0.5">Direct manager</p>
                            <p class="text-sm font-semibold text-slate-800">Maya Chen</p>
                        </div>

                        {{-- Employment Status & Work Category --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Employment status</p>
                                <p class="text-sm font-semibold text-slate-800">Active</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Work category</p>
                                <p class="text-sm font-semibold text-slate-800">Regular</p>
                            </div>
                        </div>

                        {{-- Role --}}
                        <div>
                            <p class="text-xs text-slate-400 mb-0.5">Role</p>
                            <p class="text-sm font-semibold text-slate-800">Employee</p>
                        </div>

                        {{-- Reference Face Photo --}}
                        <div class="border-t border-slate-100 pt-5">
                            <p class="text-xs text-slate-400 mb-0.5">Reference face photo</p>
                            <p class="text-sm font-semibold text-slate-800">On file &middot; Managed by HR</p>
                            <p class="text-xs text-teal-600 mt-1">Your reference photo cannot be changed in My Profile.</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bottom Info Banner --}}
            <x-info-banner>
                Only contact information is editable here. Contact HR to correct employment or identity details.
            </x-info-banner>

        </main>
    </div>

</body>

</html>
