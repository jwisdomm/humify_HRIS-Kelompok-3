<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    // Indonesian aliases
    case Disetujui = 'disetujui';
    case Ditolak = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved, self::Disetujui => 'Approved',
            self::Rejected, self::Ditolak => 'Rejected',
        };
    }
}
