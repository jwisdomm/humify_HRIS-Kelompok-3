@extends('layouts.app', [
    'title' => 'My Profile',
    'active' => 'My Profile',
    'pageTitle' => 'My Profile'
])

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">My profile</h1>
        <p class="text-xs text-slate-500 mt-1">
            Personal &amp; corporate identity &middot; {{ $employee?->full_name ?? $user->username }} ({{ $employee?->employee_code ?? 'EMP' }})
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Left Form: Editable Personal Details (MVP scope) --}}
        <div class="lg:col-span-7 bg-white border border-slate-200 rounded-xl p-6 shadow-2xs">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Personal Information</h2>
                    <p class="text-xs text-slate-400 mt-0.5">You may update your own contact details and emergency contact.</p>
                </div>
                <span class="px-2 py-0.5 text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200 rounded-full">
                    Editable by Employee
                </span>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="personal_email" class="block text-xs font-semibold text-slate-700 mb-1.5">Personal Email</label>
                        <input
                            type="email"
                            id="personal_email"
                            name="personal_email"
                            value="{{ old('personal_email', $employee?->personal_email ?? '') }}"
                            placeholder="e.g. personal@gmail.com"
                            class="w-full px-3.5 py-2 bg-white border border-slate-300 rounded-lg text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition"
                        >
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1.5">Phone Number</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $employee?->phone ?? '') }}"
                            placeholder="e.g. +62 812 3456 7890"
                            class="w-full px-3.5 py-2 bg-white border border-slate-300 rounded-lg text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition"
                        >
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-xs font-semibold text-slate-700 mb-1.5">Residential Address</label>
                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter your current residential address"
                        class="w-full px-3.5 py-2 bg-white border border-slate-300 rounded-lg text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition"
                    >{{ old('address', $employee?->address ?? '') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <h3 class="text-xs font-semibold text-slate-800 mb-3">Emergency Contact Details</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label for="emergency_contact_name" class="block text-[11px] font-medium text-slate-600 mb-1">Contact Name</label>
                            <input
                                type="text"
                                id="emergency_contact_name"
                                name="emergency_contact_name"
                                value="{{ old('emergency_contact_name', $employee?->emergency_contact_name ?? '') }}"
                                placeholder="Full Name"
                                class="w-full px-3 py-1.5 bg-white border border-slate-300 rounded-md text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600"
                            >
                        </div>
                        <div>
                            <label for="emergency_contact_phone" class="block text-[11px] font-medium text-slate-600 mb-1">Phone Number</label>
                            <input
                                type="text"
                                id="emergency_contact_phone"
                                name="emergency_contact_phone"
                                value="{{ old('emergency_contact_phone', $employee?->emergency_contact_phone ?? '') }}"
                                placeholder="Phone"
                                class="w-full px-3 py-1.5 bg-white border border-slate-300 rounded-md text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600"
                            >
                        </div>
                        <div>
                            <label for="emergency_contact_relationship" class="block text-[11px] font-medium text-slate-600 mb-1">Relationship</label>
                            <input
                                type="text"
                                id="emergency_contact_relationship"
                                name="emergency_contact_relationship"
                                value="{{ old('emergency_contact_relationship', $employee?->emergency_contact_relationship ?? '') }}"
                                placeholder="e.g. Spouse, Parent"
                                class="w-full px-3 py-1.5 bg-white border border-slate-300 rounded-md text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600"
                            >
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <button
                        type="submit"
                        class="px-5 py-2 bg-[#0F766E] hover:bg-teal-800 text-white rounded-lg text-xs font-semibold shadow-2xs transition cursor-pointer"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Right Side: Read-Only Job & Org Information (Managed by HR) --}}
        <div class="lg:col-span-5 bg-white border border-slate-200 rounded-xl p-6 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">Job &amp; Organization</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Official employment record managed by HR.</p>
                    </div>
                    <span class="px-2 py-0.5 text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200 rounded-full">
                        Read-only
                    </span>
                </div>

                <div class="space-y-3.5 text-xs">
                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Official Full Name</span>
                        <span class="font-semibold text-slate-800">{{ $employee?->full_name ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Employee ID</span>
                        <span class="font-mono font-medium text-slate-800">{{ $employee?->employee_code ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Work Email</span>
                        <span class="font-medium text-slate-800">{{ $employee?->email ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Department</span>
                        <span class="font-medium text-slate-800">{{ $employee?->department?->name ?? 'General' }}</span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Position / Job Title</span>
                        <span class="font-medium text-slate-800">{{ $employee?->position?->name ?? 'Staff' }}</span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Direct Manager</span>
                        <span class="font-medium text-slate-800">{{ $employee?->supervisor?->full_name ?? 'None' }}</span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Employment Status</span>
                        <span class="font-semibold text-emerald-700">
                            {{ ucfirst($employee?->employee_status?->value ?? (string) $employee?->employee_status ?? 'Active') }}
                        </span>
                    </div>

                    <div class="flex justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-400">Work Category</span>
                        <span class="font-medium text-slate-800">
                            {{ $employee?->is_shift_worker ? 'Shifting Worker' : 'Regular Worker' }}
                        </span>
                    </div>

                    <div class="flex justify-between py-1.5">
                        <span class="text-slate-400">Hire Date</span>
                        <span class="font-medium text-slate-800">
                            {{ $employee?->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') : '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 bg-slate-50/80 -mx-6 -mb-6 p-4 rounded-b-xl">
                <p class="text-[11px] text-slate-400 leading-relaxed">
                    Note: Department, title, manager assignments, and reference face data are managed strictly by corporate HR administrators.
                </p>
            </div>
        </div>
    </div>
@endsection
