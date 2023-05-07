<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Exception;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable (function (NotFoundResourceException $e, $request) {
            if($request->is('/api/*')){
                return response()->json(['message' => 'Model not found'], 404);
            }
        });
    }

    public function render($request, Throwable $exception)
    {
       if( $request->is('api/*')){
         if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 404,
                'error' => 'Model not found'
            ], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
           return response()->json([
            'status' => 404,
            'error' => 'Resource not found'
        ], 404);

       }
   }
}


}
