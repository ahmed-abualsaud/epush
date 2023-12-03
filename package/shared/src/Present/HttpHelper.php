<?php

use Symfony\Component\HttpKernel\Exception\HttpException;

function getResponseData($response)
{
    if (! is_array($response)) {
        return [];
    }

    if (array_key_exists("data", $response)) {
        return getResponseData($response["data"]);
    }

    return $response;
}

function jsonResponse($data, $status = 200)
{
    if (! isException($data)) {
        return successJSONResponse($data, $status);
    }

    return failureJSONResponse($data['error'], $data['status']);
}

function successJSONResponse($data, $status = 200)
{
    return response()->json(
        [
            'success' => true,
            'status' => $status,
            'message' => getCodeMessage($status),
            'data' => $data
        ], 
        $status
    );
}

function failureJSONResponse($error, $status = 500)
{
    return response()->json(
        [
            'success' => false,
            'status' => $status,
            'message' => getCodeMessage($status),
            'error' => $error
        ], 
        $status
    );
}

function fileDownloadResponse(Epush\Shared\Domain\Entity\FileDownload $fileDownload, array $headers = [])
{
    return response()->streamDownload(
        function () use ($fileDownload) { echo $fileDownload->getFileContent(); }, 
        $fileDownload->getFileName(),
        array_merge($headers, [
            'Access-Control-Expose-Headers' => 'Content-Disposition'
        ])
    );
}

function exceptionObject($status, $error = null)
{
    $message = getCodeMessage($status);

    return [
        'status' => $status,
        'message' => $message,
        'error' => $error ?? getCodeMessage($status)
    ];
}

function throwHttpException($status, $error = null)
{
    throw new HttpException((int) $status, $error ?? getCodeMessage($status));
}

function isException($exception)
{
    if (is_array($exception) && array_keys($exception) === ['status', 'message', 'error']) {
        return true;
    }

    return false;
}

function getCodeMessage($status)
{
    $messages =  getHttpCodeMessageMap();
    if (array_key_exists($status, $messages)) {
        return $messages[$status];
    }

    return "Unknown Error";
}

function getHttpCodeMessageMap()
{
    return [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        103 => 'Checkpoint',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended'
    ];
}