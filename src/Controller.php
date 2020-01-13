<?php

namespace Pen;

use Pen\Http\Response;
use Pen\Http\Request;

class Controller
{

    private $request;

    private $response;

    public function __invoke(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
