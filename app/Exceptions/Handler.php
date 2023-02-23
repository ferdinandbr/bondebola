<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
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
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        try {
            \Log::info('ROUTE '.$request->path());
            \Log::info('ERROR_CODE '.$e->getStatusCode());
            \Log::info('ERROR_MSG '.$e->getMessage());
        } catch (\Throwable $th) {}

        $error = [
            'success' => false,
            'message'=>'Ocorreu um erro interno. Contate o administrador do sistema'
        ];
        $status = 500;

        if ($e instanceof HttpException) {
            $error['message'] = $e->getMessage();
            $status = $e->getStatusCode();
        }
        return response()->json($error, $status);
    }
}