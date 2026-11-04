<?php

namespace App\Models;

if (! interface_exists(JWTSubject::class)) {
    eval('namespace PHPOpenSourceSaver\JWTAuth\Contracts {
        interface JWTSubject {
            public function getJWTIdentifier(): mixed;
            public function getJWTCustomClaims(): array;
        }
    }');
}

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasUuids, Notifiable;

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'employee_id',
        'username',
        'password',
        'password_hash',
        'role',
        'is_active',
        'last_login_at',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'password_hash',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => UserRole::class,
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Override to support both password and password_hash columns for authentication.
     */
    public function getAuthPassword(): string
    {
        return (string) ($this->password ?? $this->password_hash ?? '');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * Role helper checks.
     */
    public function isEmployee(): bool
    {
        $role = is_object($this->role) ? $this->role->value : (string) $this->role;

        return in_array($role, ['employee', 'karyawan'], true);
    }

    public function isManager(): bool
    {
        $role = is_object($this->role) ? $this->role->value : (string) $this->role;

        return $role === 'manager';
    }

    public function isHr(): bool
    {
        $role = is_object($this->role) ? $this->role->value : (string) $this->role;

        return in_array($role, ['hr_admin', 'admin_hr', 'super_admin'], true);
    }

    public function isSuperAdmin(): bool
    {
        $role = is_object($this->role) ? $this->role->value : (string) $this->role;

        return $role === 'super_admin';
    }

    public function getRoleLabelAttribute(): string
    {
        $role = is_object($this->role) ? $this->role->value : (string) $this->role;

        return match ($role) {
            'super_admin' => 'Super Admin',
            'hr_admin', 'admin_hr' => 'Admin HR',
            'manager' => 'Manager',
            'employee', 'karyawan' => 'Employee',
            default => ucfirst((string) $role),
        };
    }

    /**
     * @return BelongsTo<Employee, $this>
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * @return HasMany<Attendance, $this>
     */
    public function reviewedAttendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'reviewed_by');
    }

    /**
     * @return HasMany<LeaveRequest, $this>
     */
    public function approvedLeaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class, 'approved_by');
    }
}
