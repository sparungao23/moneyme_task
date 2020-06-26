<?php

namespace App\Services;

use Request;

/**
 * Class BaseService
 */
abstract class BaseService
{
    /**
     * Illuminate\Http\Request object
     */
    protected $request;

    /**
     * Request setter
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Request input getter
     *
     * @param $param Input key attribute
     * @return input value
     */
    public function input($param)
    {
        return Request::input($param);
    }
}
