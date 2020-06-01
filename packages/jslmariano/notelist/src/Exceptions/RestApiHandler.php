<?php

namespace Jslmariano\Notelist\Exceptions;

use Exception;
use App\Exceptions\Handler;
use Illuminate\Auth\AuthenticationException;

/**
 * Controls the data flow into notes object and updates the view whenever data
 * changes.
 *
 * We need this handler because the base App\Exceptions\Handler does not return
 * JSON formatted response in some few cases like in api,
 *
 * we simply force our only api here, so it wil be safe from the outside who
 * request to our endpoinnt regardless of the ACCCEPT HEADER - JOSEL MARIANO :)
 *
 * Credits to:
 * https://laracasts.com/discuss/channels/requests/custom-exception-handler-based-on-route-group
 * https://stackoverflow.com/questions/54895645/return-json-response-instead-of-401-blade-file
 */
class RestApiHandler extends Handler
{
    protected $api_prefix = "api/note*";

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is($this->api_prefix)) {
            if ($exception instanceof AuthenticationException)  {
                return response()->json(['message' => $exception->getMessage()], 401);
            }
        }

        return parent::render($request, $exception);
    }

}