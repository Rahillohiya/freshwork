<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Session;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if (\Illuminate\Support\Str::contains(\URL::current(), 'backend')
            || ($exception instanceof \Illuminate\Validation\ValidationException)
            || ($exception instanceof \Illuminate\Foundation\Http\Exceptions\MaintenanceModeException)
        ) {
            return parent::render($request, $exception);

        } elseif (($exception instanceof \Illuminate\Database\QueryException) || ($exception instanceof \Oseintow\Shopify\Exceptions\ShopifyApiException)) {
            Session::flash('message', 'There are some issues while processing your request.Please try in a while or contact administration if problem persists.');
            return redirect()->back()->withInput();
        } else {
            // if exception on admin panel
            $notice = "Something went wrong!";
            $message = "We're aware of this issue.Please try in a bit.If problem persists contact support team for quick fix";
            if ($request->ajax())
                return response()->json(array('status' => 'error', 'message' => $notice . " " . $message));
            else
                return view('errors.shop_not_found', compact('message', 'notice'));
        }

    }
}