<?php

namespace App\Enums;

enum EmployeeStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Resigned = 'resigned';
    case LongLeave = 'long_leave';

    // Indonesian aliases
    case Aktif = 'aktif';
    case Nonaktif = 'nonaktif';
    case Resign = 'resign';
    case CutiPanjang = 'cuti_panjang';

    public function label(): string
    {
        return match ($this) {
            self::Active, self::Aktif => 'Active',
            self::Inactive, self::Nonaktif => 'Inactive',
            self::Resigned, self::Resign => 'Resigned',
            self::LongLeave, self::CutiPanjang => 'Long Leave',
        };
    }
}
