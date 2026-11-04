<?php

namespace App\Enums;

enum RequestStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';

    // Indonesian aliases
    case Disetujui = 'disetujui';
    case Ditolak = 'ditolak';
    case Dibatalkan = 'dibatalkan';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved, self::Disetujui => 'Approved',
            self::Rejected, self::Ditolak => 'Rejected',
            self::Cancelled, self::Dibatalkan => 'Cancelled',
        };
    }
}
