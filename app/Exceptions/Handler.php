<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Support\API;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if (!($exception instanceof \ErrorException) && $request->wantsJson()) {
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return (new API())->setMessage(__('unauthenticated'))
                    ->setStatusUnauthorized()
                    ->build();
            }
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return (new API())->setMessage(__('unauthenticated'))
                    ->setErrors($exception->errors())
                    ->setStatusUnauthorized()
                    ->build();
            }
            if ($exception instanceof ModelNotFoundException) {
                $message = array_reverse(explode('\\',$exception->getMessage()));
                $message = explode(']',$message[0]);
                return (new API())->setMessage(__('This :MODEL not found',['MODEL'=>$message[0]]))
                    ->setStatusError()
                    ->build();
            }
            if ($exception instanceof NotFoundHttpException) {
                return (new API())->setMessage(__('not found'))
                    ->setErrors([
                        'url'=>__('This route not found')
                    ])
                    ->setStatusError()
                    ->build();
            }
        }
        return parent::render($request, $exception);
    }
}
