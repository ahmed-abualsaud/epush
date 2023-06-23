<?php

namespace Epush\Shared\Present;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

interface ResponseContract 
{
    public function getOriginalResponse(): HttpFoundationResponse;
}