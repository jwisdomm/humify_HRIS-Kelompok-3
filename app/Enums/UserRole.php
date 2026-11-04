<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case AdminHr = 'admin_hr';
    case Manager = 'manager';
    case Karyawan = 'karyawan';
}

