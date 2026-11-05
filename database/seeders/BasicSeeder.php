<?php

namespace Database\Seeders;

use App\Enums\ShiftCategory;
use App\Models\LeaveType;
use App\Models\WorkShift;
use Illuminate\Database\Seeder;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Work Shifts (Placeholder hours as per PRD 10.2)
        $shifts = [
            [
                'name' => 'Regular',
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
                'category' => ShiftCategory::Regular,
                'is_overnight' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Shift 1',
                'start_time' => '06:00:00',
                'end_time' => '14:00:00',
                'category' => ShiftCategory::Shifting,
                'is_overnight' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Shift 2',
                'start_time' => '14:00:00',
                'end_time' => '22:00:00',
                'category' => ShiftCategory::Shifting,
                'is_overnight' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Shift 3',
                'start_time' => '22:00:00',
                'end_time' => '06:00:00',
                'category' => ShiftCategory::Shifting,
                'is_overnight' => true,
                'is_active' => true,
            ],
        ];

        foreach ($shifts as $shift) {
            WorkShift::firstOrCreate(['name' => $shift['name']], $shift);
        }

        // Leave Types (as per PRD 10.2)
        $leaveTypes = [
            [
                'name' => 'Annual leave',
                'is_paid' => true,
                'max_days_per_year' => 12,
                'requires_attachment' => false,
            ],
            [
                'name' => 'Personal leave',
                'is_paid' => true,
                'max_days_per_year' => 3,
                'requires_attachment' => false,
            ],
            [
                'name' => 'Sick',
                'is_paid' => true,
                'max_days_per_year' => null,
                'requires_attachment' => true,
            ],
            [
                'name' => 'Permission',
                'is_paid' => true,
                'max_days_per_year' => null,
                'requires_attachment' => false,
            ],
            [
                'name' => 'Unpaid',
                'is_paid' => false,
                'max_days_per_year' => null,
                'requires_attachment' => false,
            ],
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::firstOrCreate(['name' => $leaveType['name']], $leaveType);
        }
    }
}
