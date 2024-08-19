<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return response()->view('pages.errors.404', [], 404);
        });

        $this->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 403) {
                return response()->view('pages.errors.403', [], 403);
            }
        });
        $this->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 500) {
                return response()->view('pages.errors.500', [], 500);
            }
        });
//

    }
}
