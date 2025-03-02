<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function __construct(\Illuminate\Contracts\Container\Container $container)
    {
        parent::__construct($container);
        \Log::info('Exception Handler Loaded');
    }

    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            \Log::info('Handling 404', ['path' => $request->path()]);
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Task not found',
                    'status' => 404
                ], 404);
            }
        });
    }

    public function render($request, Throwable $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($request->is('api/*') && $e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
                'status' => 422
            ], 422);
        }

        return parent::render($request, $e);
    }
}