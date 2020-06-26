<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use App\Facades\Response as AppResponse;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Response::macro('item', function ($item, $transformer, $key) {
            return AppResponse::item($item, $transformer, $key);
        });

        Response::macro('collection', function ($collection, $transformer, $key) {
            return AppResponse::collection($collection, $transformer, $key);
        });

        Response::macro('paginator', function ($paginator, $transformer, $key) {
            return AppResponse::paginator($paginator, $transformer, $key);
        });

        Response::macro('error', function ($code, $message, $extraDetails = []) {
            return AppResponse::error($code, $message, $extraDetails);
        });

        Response::macro('noContent', function () {
            return AppResponse::noContent();
        });

        Response::macro('errorForbidden', function ($message = null) {
            return AppResponse::errorForbidden($message);
        });

        Response::macro('errorNotFound', function ($message = null) {
            return AppResponse::errorNotFound($message);
        });

        Response::macro('errorBadRequest', function ($message = null) {
            return AppResponse::errorBadRequest($message);
        });

        Response::macro('errorInternal', function ($message = null) {
            return AppResponse::errorInternal($message);
        });

        Response::macro('errorUnauthorized', function ($message = null) {
            return AppResponse::errorUnauthorized($message);
        });
    }
}
