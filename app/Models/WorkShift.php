<?php

namespace App\Models;

use App\Enums\ShiftCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkShift extends Model
{
    public const UPDATED_AT = null;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'category',
        'is_overnight',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => ShiftCategory::class,
            'is_overnight' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<Attendance, $this>
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'shift_id');
    }
}
