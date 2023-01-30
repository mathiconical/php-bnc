<?php

namespace Mathiconical\PhpBnc\Endpoints;

use Mathiconical\PhpBnc\Endpoints\Endpoint;

class GetProcessResult extends Endpoint
{
    /**
     * @param array $params
     * @param array $body
     * @throws \Exception
     * @return \ArrayObject
     */
    public function get(array $params = [], array $body = [])
    {
        $json_body_string = json_encode($body);

        return $this->client->request(
            self::GET,
            self::ROUTES['result'],
            $params,
            $json_body_string ?? ''
        );
    }
}
