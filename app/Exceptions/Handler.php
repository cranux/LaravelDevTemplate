<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //捕获laravel-permission异常 然后跳转到主页
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return redirect('/');
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
            //判断token是否存在
            if (! Auth::guard('api')->parser()->setRequest($request)->hasToken()) {
                return response()->json([
                    'code' => 4002,
                    'message' => 'Token not provided',
                ]);
            }

            //判断token是否正常
            try {
                if (! Auth::guard('api')->parseToken()->authenticate()) {
                    return response()->json([
                        'code' => 4003,
                        'message' => 'jwt-auth: Member not found',
                    ]);
                }
            } catch (Exception $e) {
                return response()->json([
                    'code' => 4004,
                    'message' => 'jwt-auth: Token is error',
                ]);
            }
        }
        return parent::render($request, $exception);
    }
}
