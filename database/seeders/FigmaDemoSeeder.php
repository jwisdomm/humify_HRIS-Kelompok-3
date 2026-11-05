<?php

namespace Database\Seeders;

use App\Enums\AttendanceStatus;
use App\Enums\EmployeeStatus;
use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\RequestStatus;
use App\Enums\ReviewStatus;
use App\Enums\UserRole;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Position;
use App\Models\User;
use App\Models\WorkShift;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FigmaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123');
        $currentYear = (int) date('Y');

        // Departments
        $deptDesign = Department::firstOrCreate(['name' => 'Product Design'], ['description' => 'Product Design & UX']);
        $deptEng = Department::firstOrCreate(['name' => 'Engineering'], ['description' => 'Software Engineering & IT']);
        $deptOps = Department::firstOrCreate(['name' => 'Operations'], ['description' => 'HR & People Operations']);

        // Positions
        $posDesigner = Position::firstOrCreate(['department_id' => $deptDesign->id, 'name' => 'Product Designer'], ['level' => 1]);
        $posManager = Position::firstOrCreate(['department_id' => $deptDesign->id, 'name' => 'Design Manager'], ['level' => 2]);
        $posHr = Position::firstOrCreate(['department_id' => $deptOps->id, 'name' => 'HR Manager'], ['level' => 2]);
        $posSysAdmin = Position::firstOrCreate(['department_id' => $deptEng->id, 'name' => 'System Administrator'], ['level' => 3]);

        // 1. Maya Chen (Manager)
        $empMaya = Employee::firstOrCreate(
            ['employee_code' => 'EMP-002'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Maya Chen',
                'email' => 'maya.chen@humify.test',
                'phone' => '+62 812 3456 7002',
                'gender' => Gender::P,
                'department_id' => $deptDesign->id,
                'position_id' => $posManager->id,
                'supervisor_id' => null,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2021-03-15',
                'birth_date' => '1989-07-22',
                'birth_place' => 'Jakarta',
                'address' => 'Jl. Senopati No. 42, Jakarta Selatan',
            ]
        );

        User::firstOrCreate(
            ['username' => 'maya.chen'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empMaya->id,
                'password_hash' => $password,
                'role' => UserRole::Manager,
                'is_active' => true,
            ]
        );

        // 2. Alex Morgan (Employee - subordinate to Maya)
        $empAlex = Employee::firstOrCreate(
            ['employee_code' => 'EMP-001'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Alex Morgan',
                'email' => 'alex.morgan@humify.test',
                'phone' => '+62 812 3456 7001',
                'gender' => Gender::L,
                'department_id' => $deptDesign->id,
                'position_id' => $posDesigner->id,
                'supervisor_id' => $empMaya->id,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2022-06-01',
                'birth_date' => '1994-11-18',
                'birth_place' => 'Bandung',
                'address' => 'Jl. Kemang Raya No. 15, Jakarta Selatan',
            ]
        );

        User::firstOrCreate(
            ['username' => 'alex.morgan'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empAlex->id,
                'password_hash' => $password,
                'role' => UserRole::Karyawan,
                'is_active' => true,
            ]
        );

        // 3. Sarah Connor (Employee - subordinate to Maya)
        $empSarah = Employee::firstOrCreate(
            ['employee_code' => 'EMP-005'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Sarah Connor',
                'email' => 'sarah.connor@humify.test',
                'phone' => '+62 812 3456 7005',
                'gender' => Gender::P,
                'department_id' => $deptDesign->id,
                'position_id' => $posDesigner->id,
                'supervisor_id' => $empMaya->id,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => true,
                'hire_date' => '2023-01-10',
                'birth_date' => '1996-04-12',
                'birth_place' => 'Surabaya',
                'address' => 'Jl. Bangka IX No. 8, Jakarta Selatan',
            ]
        );

        User::firstOrCreate(
            ['username' => 'sarah.connor'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empSarah->id,
                'password_hash' => $password,
                'role' => UserRole::Karyawan,
                'is_active' => true,
            ]
        );

        // 4. Sofia Patel (Admin HR)
        $empSofia = Employee::firstOrCreate(
            ['employee_code' => 'EMP-003'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Sofia Patel',
                'email' => 'sofia.patel@humify.test',
                'phone' => '+62 812 3456 7003',
                'gender' => Gender::P,
                'department_id' => $deptOps->id,
                'position_id' => $posHr->id,
                'supervisor_id' => null,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2020-01-15',
                'birth_date' => '1987-09-05',
                'birth_place' => 'Medan',
                'address' => 'Jl. TB Simatupang No. 25, Jakarta Selatan',
            ]
        );

        User::firstOrCreate(
            ['username' => 'sofia.patel'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empSofia->id,
                'password_hash' => $password,
                'role' => UserRole::AdminHr,
                'is_active' => true,
            ]
        );

        // 5. Daniel Brooks (Super Admin)
        $empDaniel = Employee::firstOrCreate(
            ['employee_code' => 'EMP-004'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Daniel Brooks',
                'email' => 'daniel.brooks@humify.test',
                'phone' => '+62 812 3456 7004',
                'gender' => Gender::L,
                'department_id' => $deptEng->id,
                'position_id' => $posSysAdmin->id,
                'supervisor_id' => null,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2019-08-01',
                'birth_date' => '1985-02-14',
                'birth_place' => 'Jakarta',
                'address' => 'Jl. Mega Kuningan Barat No. 3, Jakarta Selatan',
            ]
        );

        User::firstOrCreate(
            ['username' => 'daniel.brooks'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empDaniel->id,
                'password_hash' => $password,
                'role' => UserRole::SuperAdmin,
                'is_active' => true,
            ]
        );

        // Leave Balances for Alex Morgan
        $annualLeaveType = LeaveType::where('name', 'Annual leave')->first() ?? LeaveType::first();
        $personalLeaveType = LeaveType::where('name', 'Personal leave')->first() ?? LeaveType::skip(1)->first();

        if ($annualLeaveType) {
            LeaveBalance::firstOrCreate(
                ['employee_id' => $empAlex->id, 'leave_type_id' => $annualLeaveType->id, 'year' => $currentYear],
                ['total_days' => 12, 'used_days' => 4]
            );
        }

        if ($personalLeaveType) {
            LeaveBalance::firstOrCreate(
                ['employee_id' => $empAlex->id, 'leave_type_id' => $personalLeaveType->id, 'year' => $currentYear],
                ['total_days' => 3, 'used_days' => 1]
            );
        }

        // Leave Requests for Alex Morgan
        if ($annualLeaveType) {
            LeaveRequest::firstOrCreate(
                ['employee_id' => $empAlex->id, 'reason' => 'Family vacation in Bali'],
                [
                    'leave_type_id' => $annualLeaveType->id,
                    'start_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                    'end_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                    'total_days' => 3,
                    'status' => RequestStatus::Pending,
                ]
            );

            LeaveRequest::firstOrCreate(
                ['employee_id' => $empAlex->id, 'reason' => 'Personal matters and renewal of documents'],
                [
                    'leave_type_id' => $annualLeaveType->id,
                    'start_date' => Carbon::now()->subDays(20)->format('Y-m-d'),
                    'end_date' => Carbon::now()->subDays(19)->format('Y-m-d'),
                    'total_days' => 2,
                    'status' => RequestStatus::Disetujui,
                    'approved_by' => User::where('username', 'maya.chen')->first()?->id,
                    'approved_at' => Carbon::now()->subDays(21),
                ]
            );
        }

        // Attendances for Alex Morgan
        $regularShift = WorkShift::first();
        $shiftId = $regularShift?->id ?? 1;

        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i);
            if ($date->isWeekend()) {
                continue;
            }

            Attendance::firstOrCreate(
                ['employee_id' => $empAlex->id, 'attendance_date' => $date->format('Y-m-d')],
                [
                    'shift_id' => $shiftId,
                    'check_in_time' => $date->copy()->setTime(8, 45 + ($i % 20), 0),
                    'check_out_time' => $date->copy()->setTime(17, 10, 0),
                    'check_in_face_verified' => true,
                    'check_in_face_score' => 96.5,
                    'status' => $i === 2 ? AttendanceStatus::Terlambat : AttendanceStatus::Hadir,
                    'late_minutes' => $i === 2 ? 15 : 0,
                    'review_status' => $i === 0 ? ReviewStatus::Pending : ReviewStatus::Disetujui,
                    'notes' => 'Presensi mobile regular',
                ]
            );
        }

        // Attendances for Sarah Connor (Direct report with pending review)
        Attendance::firstOrCreate(
            ['employee_id' => $empSarah->id, 'attendance_date' => Carbon::today()->format('Y-m-d')],
            [
                'shift_id' => $shiftId,
                'check_in_time' => Carbon::today()->setTime(8, 55, 0),
                'check_out_time' => null,
                'check_in_face_verified' => true,
                'check_in_face_score' => 94.0,
                'status' => AttendanceStatus::Hadir,
                'late_minutes' => 0,
                'review_status' => ReviewStatus::Pending,
                'notes' => 'Presensi mobile regular',
            ]
        );
    }
}
