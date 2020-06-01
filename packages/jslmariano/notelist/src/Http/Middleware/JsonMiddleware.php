<?php

namespace Jslmariano\Notelist\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

/**
 * This class describes a json middleware.
 *
 * Convert all reponse to json
 *
 * https://medium.com/@DarkGhostHunter/laravel-convert-to-json-all-responses-automatically-c4a72b2fd3ac
 */
class JsonMiddleware
{
    /**
     * The Response Factory our app uses
     *
     * @var ResponseFactory
     */
    protected $factory;

    /**
     * JsonMiddleware constructor.
     *
     * @param ResponseFactory $factory
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        // Get the response
        $response = $next($request);


        // If the response is not strictly a JsonResponse, we make it
        if (!$response instanceof JsonResponse) {
            $response = $this->factory->json(
                $response->content(),
                $response->status(),
                $response->headers->all()
            );
        }

        return $response;
    }
}
