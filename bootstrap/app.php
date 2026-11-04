<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/v1',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e): bool {
            return $request->is('api/*') || $request->expectsJson();
        });

        // Trigger QueryException (SQLSTATE 45000)
        $exceptions->render(function (QueryException $e, Request $request) {
            if (($e->errorInfo[0] ?? null) === '45000') {
                return response()->json([
                    'message' => $e->errorInfo[2] ?? 'Shift tidak sesuai kategori karyawan',
                    'code' => 'SHIFT_NOT_ALLOWED',
                    'errors' => null,
                ], 422);
            }
        });

        // Validation Exception
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 'VALIDATION_ERROR',
                'errors' => $e->errors(),
            ], 422);
        });

        // Authentication Exception
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'message' => 'Belum login atau token tidak valid.',
                'code' => 'UNAUTHENTICATED',
                'errors' => null,
            ], 401);
        });

        // Authorization Exception
        $exceptions->render(function (AuthorizationException|AccessDeniedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Role tidak berhak.',
                'code' => 'FORBIDDEN',
                'errors' => null,
            ], 403);
        });

        // Not Found Exception
        $exceptions->render(function (NotFoundHttpException|ModelNotFoundException $e, Request $request) {
            return response()->json([
                'message' => 'Data tidak ditemukan atau di luar cakupan.',
                'code' => 'NOT_FOUND',
                'errors' => null,
            ], 404);
        });

        // Rate limit Exception
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            return response()->json([
                'message' => 'Batas percobaan terlampaui.',
                'code' => 'TOO_MANY_REQUESTS',
                'errors' => null,
            ], 429);
        });
    })->create();
