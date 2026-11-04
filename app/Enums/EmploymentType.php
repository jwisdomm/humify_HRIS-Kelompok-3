<?php

namespace App\Enums;

enum EmploymentType: string
{
    case Tetap = 'tetap';
    case Kontrak = 'kontrak';
    case Magang = 'magang';
    case Harian = 'harian';
}

