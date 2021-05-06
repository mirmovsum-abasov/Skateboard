<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        switch (class_basename($exception)) {
            case 'TokenMismatchException':
                return response()->json(['error' => 66, 'errors' => ['forms' => 'Your request was denied. Please try again or reload your page']], 403);
                break;
            case 'ThrottleRequestsException':
                return response()->json(['errors' => ['forms' => 'You have been rate limited, please try again shortly']], 429);
                break;
            case 'MethodNotAllowedHttpException':
                if ($request->expectsJson()) {
                    return response()->json(['errors' => ['forms' => 'Method Not Allowed']], 405);
                }
                return redirect()->route('dashboard');
                break;
            case 'NotFoundHttpException':
                if ($request->expectsJson()) {
                    return response()->json(['errors' => ['forms' => 'We could not locate the data you requested, it may have been lost forever']], 404);
                }
                return parent::render($request, $exception);
                break;
            case 'MaintenanceModeException':
                if ($request->expectsJson()) {
                    return response()->json(['errors' => ['forms' => 'The site is currently down for maintenance, please check back with us soon']], 503);
                }
                return parent::render($request, $exception);
                break;
            case 'ValidationException':
                return parent::render($request, $exception);
                break;
        }
        if (app()->isProduction()) {
            if ($request->expectsJson()) {
                return response()->json('Server Error', 500);
            }
            return response()->view('errors.500', [], 500);
        }
        return parent::render($request, $exception);
    }
}
