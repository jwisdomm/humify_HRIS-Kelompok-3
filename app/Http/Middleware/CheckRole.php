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
        $user = $request->user('api');

        if (! $user) {
            throw new ApiException('Belum login atau token tidak valid.', 'UNAUTHENTICATED', 401);
        }

        // Muat ulang user dari database pada setiap request sesuai aturan 6.2
        $user = $user->fresh();
        if (! $user) {
            throw new ApiException('Akun tidak ditemukan.', 'UNAUTHENTICATED', 401);
        }

        if (! $user->is_active) {
            throw new ApiException('Akun dinonaktifkan.', 'ACCOUNT_INACTIVE', 403);
        }

        if ($user->employee && in_array($user->employee->employee_status?->value ?? $user->employee->employee_status, ['nonaktif', 'resign'], true)) {
            throw new ApiException('Karyawan nonaktif atau resign.', 'EMPLOYEE_INACTIVE', 403);
        }

        $userRole = is_object($user->role) ? $user->role->value : (string) $user->role;

        if (! empty($roles) && ! in_array($userRole, $roles, true)) {
            throw new ApiException('Role tidak berhak.', 'FORBIDDEN', 403);
        }

        return $next($request);
    }
}
