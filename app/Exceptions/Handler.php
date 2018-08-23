<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Debug\Exception\FatalErrorException;

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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // Handle http method not allow (fix laravel 4.2).
        if ($exception instanceof MethodNotAllowedHttpException) {
            abort(404);
        }

        // Handle 404.
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Handle all exception throw in controller, service, model....
        if (! config('app.debug')) {
            # Handle timeout.
            if ($exception instanceof FatalErrorException) {
                // Request Timeout.
                if (strpos($message = $exception->getMessage(), 'Maximum execution time') === 0) {
                    return response()->view('errors.server', ['message' => trans('messages.timeout')], 504);
                }
            }

            // Handle 500: show page error page (status code 500) with exception message in site.
            if ($exception instanceof Exception) {
                return response()->view('errors.500', ['message' => $exception->getMessage()], 500);
            }
        }

        return parent::render($request, $exception);
    }
}
