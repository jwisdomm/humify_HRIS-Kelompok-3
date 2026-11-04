<?php

namespace App\Enums;

enum EmploymentType: string
{
    case Permanent = 'permanent';
    case Contract = 'contract';
    case Internship = 'internship';
    case Daily = 'daily';

    // Indonesian aliases
    case Tetap = 'tetap';
    case Kontrak = 'kontrak';
    case Magang = 'magang';
    case Harian = 'harian';

    public function label(): string
    {
        return match ($this) {
            self::Permanent, self::Tetap => 'Permanent',
            self::Contract, self::Kontrak => 'Contract',
            self::Internship, self::Magang => 'Internship',
            self::Daily, self::Harian => 'Daily',
        };
    }
}
