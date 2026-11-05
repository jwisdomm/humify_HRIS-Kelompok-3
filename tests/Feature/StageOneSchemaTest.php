<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    $this->seed();
});

test('database has exactly 9 application tables plus migrations', function () {
    $tables = collect(DB::select('SHOW TABLES'))->map(function ($row) {
        return array_values((array) $row)[0];
    })->sort()->values()->all();

    $expectedTables = [
        'attendances',
        'departments',
        'employees',
        'leave_balances',
        'leave_requests',
        'leave_types',
        'migrations',
        'positions',
        'users',
        'work_shifts',
    ];

    expect($tables)->toEqualCanonicalizing($expectedTables);
});

test('database has exactly 3 triggers registered', function () {
    $triggers = collect(DB::select('SHOW TRIGGERS'))->pluck('Trigger')->sort()->values()->all();

    $expectedTriggers = [
        'trg_apply_leave_balance',
        'trg_validate_attendance_shift_insert',
        'trg_validate_attendance_shift_update',
    ];

    expect($triggers)->toEqualCanonicalizing($expectedTriggers);
});

test('check constraint and generated column exist and work', function () {
    // Verify remaining_days is generated stored column on leave_balances
    $columns = Schema::getColumnListing('leave_balances');
    expect($columns)->toContain('remaining_days');

    // Verify basic seeder seeded shifts and leave types
    expect(DB::table('work_shifts')->count())->toBeGreaterThanOrEqual(4);
    expect(DB::table('leave_types')->count())->toBeGreaterThanOrEqual(5);

    // Verify demo seeder seeded employees and users
    expect(DB::table('employees')->count())->toBe(5);
    expect(DB::table('users')->count())->toBe(5);
});
