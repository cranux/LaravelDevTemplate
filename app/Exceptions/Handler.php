<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Render an exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e){
        //捕获laravel-permission异常 然后跳转到主页
        if ($e instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return redirect('/');
        }
        if (request()->segment(1) == 'api') {
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
                //判断token是否存在
                if (!Auth::guard('api')->parser()->setRequest($request)->hasToken()) {
                    return response()->json([
                        'code' => 4002,
                        'message' => 'Token not provided',
                    ]);
                }

                //判断token是否正常
                try {
                    if (!Auth::guard('api')->parseToken()->authenticate()) {
                        return response()->json([
                            'code' => 4003,
                            'message' => 'jwt-auth: Member not found',
                        ]);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'code' => 4004,
                        'message' => 'jwt-auth: Token is error',
                    ]);
                }
            }
            if ($e) {
                $errorData = $this->convertExceptionToArray($e);
                return json(5001,'error',$errorData);
            }
        }
        return parent::render($request, $e);
    }
}
