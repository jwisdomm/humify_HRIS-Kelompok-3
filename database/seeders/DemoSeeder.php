<?php

namespace Database\Seeders;

use App\Enums\EmployeeStatus;
use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\UserRole;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoPassword = env('DEMO_PASSWORD', 'password123');
        $passwordHash = Hash::make($demoPassword);
        $currentYear = (int) Carbon::now(config('humify.timezone', 'Asia/Jakarta'))->format('Y');

        // 1. Departments
        $deptIt = Department::firstOrCreate(
            ['name' => 'Teknologi Informasi'],
            ['description' => 'Departemen IT dan Rekayasa Perangkat Lunak']
        );

        $deptHr = Department::firstOrCreate(
            ['name' => 'Sumber Daya Manusia'],
            ['description' => 'Departemen Pengelolaan SDM dan Personalia']
        );

        $deptOps = Department::firstOrCreate(
            ['name' => 'Operasional'],
            ['description' => 'Departemen Operasional dan Layanan Pelanggan']
        );

        // 2. Positions
        $posItDirector = Position::firstOrCreate(
            ['department_id' => $deptIt->id, 'name' => 'IT Director'],
            ['level' => 3]
        );

        $posHrStaff = Position::firstOrCreate(
            ['department_id' => $deptHr->id, 'name' => 'HR Staff'],
            ['level' => 1]
        );

        $posOpsManager = Position::firstOrCreate(
            ['department_id' => $deptOps->id, 'name' => 'Operations Manager'],
            ['level' => 2]
        );

        $posCsRegular = Position::firstOrCreate(
            ['department_id' => $deptOps->id, 'name' => 'Customer Service Regular'],
            ['level' => 1]
        );

        $posCsShifting = Position::firstOrCreate(
            ['department_id' => $deptOps->id, 'name' => 'Customer Service Shifting'],
            ['level' => 1]
        );

        // 3. Employees & Users (Super Admin, Admin HR, Manager, Karyawan Regular, Karyawan Shifting)
        // Super Admin
        $empSuperAdmin = Employee::firstOrCreate(
            ['employee_code' => 'EMP-SA01'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Budi Super Admin',
                'email' => 'superadmin@humify.test',
                'phone' => '081234567890',
                'gender' => Gender::L,
                'birth_place' => 'Jakarta',
                'birth_date' => '1985-05-15',
                'address' => 'Jl. Jenderal Sudirman No. 1, Jakarta',
                'department_id' => $deptIt->id,
                'position_id' => $posItDirector->id,
                'supervisor_id' => null,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2022-01-01',
            ]
        );
        User::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empSuperAdmin->id,
                'password_hash' => $passwordHash,
                'role' => UserRole::SuperAdmin,
                'is_active' => true,
            ]
        );

        // Admin HR
        $empAdminHr = Employee::firstOrCreate(
            ['employee_code' => 'EMP-HR01'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Siti Admin HR',
                'email' => 'adminhr@humify.test',
                'phone' => '081234567891',
                'gender' => Gender::P,
                'birth_place' => 'Bandung',
                'birth_date' => '1990-08-20',
                'address' => 'Jl. Gatot Subroto No. 10, Jakarta',
                'department_id' => $deptHr->id,
                'position_id' => $posHrStaff->id,
                'supervisor_id' => null,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2022-03-01',
            ]
        );
        User::firstOrCreate(
            ['username' => 'adminhr'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empAdminHr->id,
                'password_hash' => $passwordHash,
                'role' => UserRole::AdminHr,
                'is_active' => true,
            ]
        );

        // Manager
        $empManager = Employee::firstOrCreate(
            ['employee_code' => 'EMP-MGR01'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Doni Manager',
                'email' => 'manager@humify.test',
                'phone' => '081234567892',
                'gender' => Gender::L,
                'birth_place' => 'Surabaya',
                'birth_date' => '1988-11-10',
                'address' => 'Jl. Rasuna Said No. 5, Jakarta',
                'department_id' => $deptOps->id,
                'position_id' => $posOpsManager->id,
                'supervisor_id' => null,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2022-02-01',
            ]
        );
        User::firstOrCreate(
            ['username' => 'manager'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empManager->id,
                'password_hash' => $passwordHash,
                'role' => UserRole::Manager,
                'is_active' => true,
            ]
        );

        // Karyawan Regular (bawahan Manager)
        $empRegular = Employee::firstOrCreate(
            ['employee_code' => 'EMP-REG01'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Andi Karyawan Regular',
                'email' => 'andi@humify.test',
                'phone' => '081234567893',
                'gender' => Gender::L,
                'birth_place' => 'Semarang',
                'birth_date' => '1995-03-12',
                'address' => 'Jl. Tebet Raya No. 12, Jakarta',
                'department_id' => $deptOps->id,
                'position_id' => $posCsRegular->id,
                'supervisor_id' => $empManager->id,
                'employment_type' => EmploymentType::Tetap,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => false,
                'hire_date' => '2023-01-10',
            ]
        );
        User::firstOrCreate(
            ['username' => 'karyawan'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empRegular->id,
                'password_hash' => $passwordHash,
                'role' => UserRole::Karyawan,
                'is_active' => true,
            ]
        );

        // Karyawan Shifting (bawahan Manager)
        $empShifting = Employee::firstOrCreate(
            ['employee_code' => 'EMP-SHF01'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Rian Karyawan Shifting',
                'email' => 'rian@humify.test',
                'phone' => '081234567894',
                'gender' => Gender::L,
                'birth_place' => 'Yogyakarta',
                'birth_date' => '1997-07-25',
                'address' => 'Jl. Kemang Raya No. 20, Jakarta',
                'department_id' => $deptOps->id,
                'position_id' => $posCsShifting->id,
                'supervisor_id' => $empManager->id,
                'employment_type' => EmploymentType::Kontrak,
                'employee_status' => EmployeeStatus::Aktif,
                'is_shift_worker' => true,
                'hire_date' => '2023-02-01',
            ]
        );
        User::firstOrCreate(
            ['username' => 'karyawanshift'],
            [
                'id' => (string) Str::uuid(),
                'employee_id' => $empShifting->id,
                'password_hash' => $passwordHash,
                'role' => UserRole::Karyawan,
                'is_active' => true,
            ]
        );

        // 4. Saldo awal tahun berjalan untuk semua karyawan demo
        $annualLeave = LeaveType::where('name', 'Annual leave')->first();
        $personalLeave = LeaveType::where('name', 'Personal leave')->first();

        $allDemoEmployees = [$empSuperAdmin, $empAdminHr, $empManager, $empRegular, $empShifting];

        foreach ($allDemoEmployees as $emp) {
            if ($annualLeave) {
                LeaveBalance::firstOrCreate(
                    [
                        'employee_id' => $emp->id,
                        'leave_type_id' => $annualLeave->id,
                        'year' => $currentYear,
                    ],
                    [
                        'total_days' => 12.0,
                        'used_days' => 0.0,
                    ]
                );
            }

            if ($personalLeave) {
                LeaveBalance::firstOrCreate(
                    [
                        'employee_id' => $emp->id,
                        'leave_type_id' => $personalLeave->id,
                        'year' => $currentYear,
                    ],
                    [
                        'total_days' => 3.0,
                        'used_days' => 0.0,
                    ]
                );
            }
        }
    }
}

