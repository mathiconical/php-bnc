<?php

namespace Mathiconical\PhpBnc\Endpoints;

use Mathiconical\PhpBnc\Endpoints\Endpoint;

class GetProcessGuid extends Endpoint
{
    /**
     * @param array $options
     * @param array $body
     * @throws \Exception
     * @return \ArrayObject
     */
    public function get(array $options = [], array $body = [])
    {
        $json_body_string = json_encode($body);

        return $this->client->request(
            self::GET,
            self::ROUTES['guid'],
            $options,
            $json_body_string ?? ''
        );
    }
}
