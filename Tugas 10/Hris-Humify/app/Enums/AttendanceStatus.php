<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case Present = 'present';
    case Late = 'late';
    case EarlyLeave = 'early_leave';
    case Leave = 'leave';
    case Sick = 'sick';
    case Permission = 'permission';
    case Absent = 'absent';
    case Holiday = 'holiday';

    // Indonesian aliases
    case Hadir = 'hadir';
    case Terlambat = 'terlambat';
    case PulangCepat = 'pulang_cepat';
    case Izin = 'izin';
    case Sakit = 'sakit';
    case Cuti = 'cuti';
    case Alpha = 'alpha';
    case Libur = 'libur';

    public function label(): string
    {
        return match ($this) {
            self::Present, self::Hadir => 'Present',
            self::Late, self::Terlambat => 'Late',
            self::EarlyLeave, self::PulangCepat => 'Early Leave',
            self::Leave, self::Cuti => 'Leave',
            self::Sick, self::Sakit => 'Sick',
            self::Permission, self::Izin => 'Permission',
            self::Absent, self::Alpha => 'Absent',
            self::Holiday, self::Libur => 'Holiday',
        };
    }
}
