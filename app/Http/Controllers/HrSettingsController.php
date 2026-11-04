<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\WorkShift;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HrSettingsController extends Controller
{
    /**
     * W11: Shift Settings.
     */
    public function shifts(): View
    {
        $shifts = WorkShift::orderBy('category')->orderBy('start_time')->get();

        return view('hr.shifts.index', [
            'shifts' => $shifts,
        ]);
    }

    public function storeShift(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'category' => ['required', 'in:regular,shifting'],
            'is_overnight' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        WorkShift::create([
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'category' => $validated['category'],
            'is_overnight' => $request->boolean('is_overnight'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('hr.shifts')->with('success', "Shift {$validated['name']} berhasil ditambahkan.");
    }

    public function updateShift(Request $request, int $id): RedirectResponse
    {
        $shift = WorkShift::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'category' => ['required', 'in:regular,shifting'],
            'is_overnight' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $shift->update([
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'category' => $validated['category'],
            'is_overnight' => $request->boolean('is_overnight'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('hr.shifts')->with('success', "Shift {$shift->name} berhasil diperbarui.");
    }

    /**
     * W12: Leave Types and Leave Balances.
     */
    public function leaveSettings(Request $request): View
    {
        $tab = $request->input('tab', 'types');
        $currentYear = (int) $request->input('year', date('Y'));

        $leaveTypes = LeaveType::orderBy('name')->get();

        $employees = Employee::orderBy('full_name')->get();

        $balancesQuery = LeaveBalance::with(['employee.department', 'leaveType'])
            ->where('year', $currentYear);

        if ($request->filled('employee_id')) {
            $balancesQuery->where('employee_id', $request->input('employee_id'));
        }

        $balances = $balancesQuery->paginate(15)->withQueryString();

        return view('hr.leaves.index', [
            'tab' => $tab,
            'currentYear' => $currentYear,
            'leaveTypes' => $leaveTypes,
            'employees' => $employees,
            'balances' => $balances,
            'selectedEmployeeId' => $request->input('employee_id'),
        ]);
    }

    public function storeLeaveType(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:leave_types,name'],
            'is_paid' => ['boolean'],
            'max_days_per_year' => ['nullable', 'integer', 'min:1'],
            'requires_attachment' => ['boolean'],
            'tracks_balance' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        LeaveType::create([
            'name' => $validated['name'],
            'is_paid' => $request->boolean('is_paid', true),
            'max_days_per_year' => $validated['max_days_per_year'] ?? null,
            'requires_attachment' => $request->boolean('requires_attachment'),
            'tracks_balance' => $request->boolean('tracks_balance', true),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('hr.leave-settings', ['tab' => 'types'])->with('success', "Jenis cuti {$validated['name']} berhasil ditambahkan.");
    }

    public function updateLeaveType(Request $request, int $id): RedirectResponse
    {
        $leaveType = LeaveType::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:leave_types,name,'.$id],
            'is_paid' => ['boolean'],
            'max_days_per_year' => ['nullable', 'integer', 'min:1'],
            'requires_attachment' => ['boolean'],
            'tracks_balance' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $leaveType->update([
            'name' => $validated['name'],
            'is_paid' => $request->boolean('is_paid'),
            'max_days_per_year' => $validated['max_days_per_year'] ?? null,
            'requires_attachment' => $request->boolean('requires_attachment'),
            'tracks_balance' => $request->boolean('tracks_balance'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('hr.leave-settings', ['tab' => 'types'])->with('success', "Jenis cuti {$leaveType->name} berhasil diperbarui.");
    }

    public function saveBalance(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
            'leave_type_id' => ['required', 'exists:leave_types,id'],
            'year' => ['required', 'integer', 'min:2020', 'max:2030'],
            'total_days' => ['required', 'numeric', 'min:0', 'max:100'],
            'used_days' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        LeaveBalance::updateOrCreate(
            [
                'employee_id' => $validated['employee_id'],
                'leave_type_id' => $validated['leave_type_id'],
                'year' => $validated['year'],
            ],
            [
                'total_days' => $validated['total_days'],
                'used_days' => $validated['used_days'] ?? 0,
            ]
        );

        return redirect()->route('hr.leave-settings', ['tab' => 'balances', 'year' => $validated['year']])
            ->with('success', 'Saldo cuti karyawan berhasil disimpan.');
    }

    /**
     * W13: Monthly Attendance Report.
     */
    public function reports(Request $request): View
    {
        $month = (int) $request->input('month', date('n'));
        $year = (int) $request->input('year', date('Y'));
        $departmentId = $request->input('department_id');
        $employeeId = $request->input('employee_id');

        $departments = Department::orderBy('name')->get();
        $employees = Employee::orderBy('full_name')->get();

        $query = Employee::with(['department', 'position'])
            ->whereIn('employee_status', ['active', 'aktif']);

        if (! empty($departmentId)) {
            $query->where('department_id', $departmentId);
        }

        if (! empty($employeeId)) {
            $query->where('id', $employeeId);
        }

        $reportEmployees = $query->get();

        // Calculate metrics for each employee
        $reportData = $reportEmployees->map(function ($emp) use ($month, $year) {
            $attendances = Attendance::where('employee_id', $emp->id)
                ->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month)
                ->get();

            $present = $attendances->filter(fn ($a) => in_array($a->status?->value ?? $a->status, ['present', 'hadir']))->count();
            $late = $attendances->filter(fn ($a) => in_array($a->status?->value ?? $a->status, ['late', 'terlambat']))->count();
            $lateMinutes = $attendances->sum('late_minutes');
            $permission = $attendances->filter(fn ($a) => in_array($a->status?->value ?? $a->status, ['permission', 'izin']))->count();
            $sick = $attendances->filter(fn ($a) => in_array($a->status?->value ?? $a->status, ['sick', 'sakit']))->count();
            $leave = $attendances->filter(fn ($a) => in_array($a->status?->value ?? $a->status, ['leave', 'cuti']))->count();
            $alpha = $attendances->filter(fn ($a) => in_array($a->status?->value ?? $a->status, ['absent', 'alpha']))->count();

            return [
                'employee' => $emp,
                'present' => $present,
                'late' => $late,
                'late_minutes' => $lateMinutes,
                'permission' => $permission,
                'sick' => $sick,
                'leave' => $leave,
                'alpha' => $alpha,
                'total_records' => $attendances->count(),
            ];
        });

        // Totals
        $totals = [
            'present' => $reportData->sum('present'),
            'late' => $reportData->sum('late'),
            'late_minutes' => $reportData->sum('late_minutes'),
            'permission' => $reportData->sum('permission'),
            'sick' => $reportData->sum('sick'),
            'leave' => $reportData->sum('leave'),
            'alpha' => $reportData->sum('alpha'),
        ];

        return view('hr.reports.index', [
            'reportData' => $reportData,
            'totals' => $totals,
            'departments' => $departments,
            'employees' => $employees,
            'month' => $month,
            'year' => $year,
            'departmentId' => $departmentId,
            'employeeId' => $employeeId,
        ]);
    }
}
