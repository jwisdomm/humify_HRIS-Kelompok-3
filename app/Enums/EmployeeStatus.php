<?php

namespace App\Enums;

enum EmployeeStatus: string
{
    case Aktif = 'aktif';
    case Nonaktif = 'nonaktif';
    case Resign = 'resign';
    case CutiPanjang = 'cuti_panjang';
}

