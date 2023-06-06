<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;

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

        // $this->renderable(function (\Exception $e) {
        //     if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
        //         return redirect()->route('login');
        //     };
        // });
    }

    // public function report(Exception $exception){
    //     parent::report($exception);
    // }

    // public function render($request, Exception $exception){
    //     // return redirect()->action('HomeController@index');
    //     return parent::render($request, $exception);
    //     // return redirect()->action('HomeController@index');
    // }

    // public function render($request, Excepti/on $exception){
    //     return parent::render($request, $exception);
    //     // if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
    //     //     return redirect()->route('login');
    //     // }
    // }
}
