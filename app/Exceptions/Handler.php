<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $exception->getMessage()], 401);
            }

            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->guest('admin/login');
            }

            return redirect()->guest($exception->redirectTo() ?? 'login');
        } else if ($exception instanceof TokenMismatchException) {
            return redirect()
                ->back()
                ->withInput($request->except('_token'))
                ->withError('Oops! Seems you couldn\'t submit the form for a long time. Please try again.');
        }

        return parent::render($request, $exception);
    }
}
