<?php

namespace Epush\Shared\Present;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Response extends HttpFoundationResponse implements ResponseContract 
{
    public function __construct(private HttpFoundationResponse $response) {
        parent::__construct();
    }

    public function getOriginalResponse(): HttpFoundationResponse
    {
        return $this->response;
    }
}