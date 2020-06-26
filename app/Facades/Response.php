<?php

namespace App\Facades;

use Illuminate\Support\Facades\Response as BaseResponse;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class Response.
 *
 * @package App\Facades
 */
class Response extends BaseResponse
{
    /**
     * Fractal item response.
     *
     * @param $item
     * @param $transformer
     * @param $key
     *
     * @return mixed
     */
    public static function item($item, $transformer, $key)
    {
        if (is_array($key)) {
            $key = $key['key'];
        }

        $content = fractal()
            ->withResourceName($key)
            ->item($item)
            ->transformWith($transformer)
            ->parseIncludes(Request::input('include'))
            ->toArray();

        return self::json($content);
    }

    /**
     * Fractal collection response.
     *
     * @param $collection
     * @param $transformer
     * @param $key
     *
     * @return mixed
     */
    public static function collection($collection, $transformer, $key)
    {
        if (is_array($key)) {
            $key = $key['key'];
        }

        $content = fractal()
            ->collection($collection)
            ->transformWith($transformer)
            ->parseIncludes(Request::input('include'))
            ->withResourceName($key)
            ->toArray();

        return self::json($content);
    }

    /**
     * Fractal pagination response.
     *
     * @param $paginator
     * @param $transformer
     * @param $key
     *
     * @return mixed
     */
    public static function paginator($paginator, $transformer, $key)
    {
        if (is_array($key)) {
            $key = $key['key'];
        }

        $content = fractal()
            ->collection($paginator->items())
            ->transformWith($transformer)
            ->parseIncludes(Request::input('include'))
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->withResourceName($key)
            ->toArray();

        return self::json($content);
    }

    /**
     * Error Response.
     *
     * @param int $code
     * @param string $message
     * @param array $extraDetails
     *
     * @return mixed
     */
    public static function error($code, $message = null, $extraDetails = [])
    {
        $allowed = ['links', 'id', 'code', 'source', 'meta', 'debug'];

        $extraDetails = array_intersect_key($extraDetails, array_flip($allowed));

        $title = isset(SymfonyResponse::$statusTexts[$code]) ? SymfonyResponse::$statusTexts[$code] : 'Error';

        if ($message) {
            $extraDetails['detail'] = $message;
        }

        return self::json(
            [
                'errors' => [
                    array_merge([
                        'status' => (string) $code,
                        'title' => $title,
                    ], $extraDetails)
                ]
            ],
            $code
        );
    }

    /**
     * Error Response.
     *
     * @return mixed
     */
    public static function noContent()
    {
        return self::make('', 204);
    }

    /**
     * Error Response.
     *
     * @param string $message
     *
     * @return mixed
     */
    public static function errorForbidden($message = null)
    {
        return self::error(403, $message);
    }

    /**
     * Error Response.
     *
     * @param string $message
     *
     * @return mixed
     */
    public static function errorNotFound($message = null)
    {
        return self::error(404, $message);
    }

    /**
     * Error Response.
     *
     * @param string $message
     *
     * @return mixed
     */
    public static function errorBadRequest($message = null)
    {
        return self::error(400, $message);
    }

    /**
     * Error Response.
     *
     * @param string $message
     *
     * @return mixed
     */
    public static function errorInternal($message = null)
    {
        return self::error(500, $message);
    }

    /**
     * Error Response.
     *
     * @param string $message
     *
     * @return mixed
     */
    public static function errorUnauthorized($message = null)
    {
        return self::error(401, $message);
    }
}
