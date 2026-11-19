<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case AdminHr = 'admin_hr';
    case HrAdmin = 'hr_admin';
    case Manager = 'manager';
    case Karyawan = 'karyawan';
    case Employee = 'employee';

    public function isEmployee(): bool
    {
        return in_array($this, [self::Karyawan, self::Employee], true);
    }

    public function isManager(): bool
    {
        return $this === self::Manager;
    }

    public function isHr(): bool
    {
        return in_array($this, [self::AdminHr, self::HrAdmin, self::SuperAdmin], true);
    }

    public function isSuperAdmin(): bool
    {
        return $this === self::SuperAdmin;
    }
}
