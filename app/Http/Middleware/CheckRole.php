<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user('web') ?? $request->user('api') ?? $request->user();

        if (! $user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                throw new ApiException('Belum login atau token tidak valid.', 'UNAUTHENTICATED', 401);
            }

            return redirect()->guest(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Muat ulang user dari database pada setiap request sesuai aturan 6.2
        $user = $user->fresh();
        if (! $user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                throw new ApiException('Akun tidak ditemukan.', 'UNAUTHENTICATED', 401);
            }

            auth()->logout();

            return redirect()->route('login')->with('error', 'Akun tidak ditemukan.');
        }

        if (! $user->is_active) {
            if ($request->expectsJson() || $request->is('api/*')) {
                throw new ApiException('Akun dinonaktifkan.', 'ACCOUNT_INACTIVE', 403);
            }

            auth()->logout();

            return redirect()->route('login')->with('error', 'Akun Anda dinonaktifkan.');
        }

        $employeeStatus = $user->employee?->employee_status?->value ?? $user->employee?->employee_status;
        if ($user->employee && in_array($employeeStatus, ['nonaktif', 'resign', 'inactive', 'resigned'], true)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                throw new ApiException('Karyawan nonaktif atau resign.', 'EMPLOYEE_INACTIVE', 403);
            }

            auth()->logout();

            return redirect()->route('login')->with('error', 'Status karyawan nonaktif atau resign.');
        }

        $userRole = is_object($user->role) ? $user->role->value : (string) $user->role;

        // Normalize roles comparison
        $normalizedUserRole = match ($userRole) {
            'employee', 'karyawan' => 'karyawan',
            'hr_admin', 'admin_hr' => 'admin_hr',
            default => $userRole,
        };

        $normalizedAllowedRoles = array_map(function ($r) {
            return match ($r) {
                'employee', 'karyawan' => 'karyawan',
                'hr_admin', 'admin_hr' => 'admin_hr',
                default => $r,
            };
        }, $roles);

        // Super Admin has all HR privileges
        $isAllowed = empty($roles)
            || in_array($normalizedUserRole, $normalizedAllowedRoles, true)
            || ($normalizedUserRole === 'super_admin' && in_array('admin_hr', $normalizedAllowedRoles, true));

        if (! $isAllowed) {
            if ($request->expectsJson() || $request->is('api/*')) {
                throw new ApiException('Role tidak berhak.', 'FORBIDDEN', 403);
            }

            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}
