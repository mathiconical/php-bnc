<?php

namespace Mathiconical\PhpBnc\Endpoints;

use Exception;
use GuzzleHttp\Exception\ClientException;

class ResponseHandler
{
    /**
     * @param string $payload
     * @return \ArrayObject
     */
    public static function success($payload)
    {
        return self::toJson($payload);
    }

    /**
     * @param string $json
     * @return \ArrayObject
     */
    private static function toJson($json)
    {
        $res = json_decode($json);

        if (json_last_error() != \JSON_ERROR_NONE) {
            throw new Exception(json_last_error_msg());
        }

        return $res;
    }
}
