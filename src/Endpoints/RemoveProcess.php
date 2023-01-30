<?php

namespace Mathiconical\PhpBnc\Endpoints;

use Mathiconical\PhpBnc\Endpoints\Endpoint;

class RemoveProcess extends Endpoint
{
    /**
     * @param array $params
     * @param array $body
     * @throws \Exception
     * @return \ArrayObject
     */
    public function remove(array $params = [], array $body = [])
    {
        $json_body_string = json_encode($body);

        return $this->client->request(
            self::POST,
            self::ROUTES['removeProcess'],
            $params,
            $json_body_string ?? ''
        );
    }
}
