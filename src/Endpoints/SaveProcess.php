<?php

namespace Mathiconical\PhpBnc\Endpoints;

use Mathiconical\PhpBnc\Endpoints\Endpoint;

class SaveProcess extends Endpoint
{
    /**
     * @param array $params
     * @param array $body
     * @throws \Exception
     * @return \ArrayObject
     */
    public function save(array $params = [], array $body = [])
    {
        $json_body_string = json_encode($body);

        return $this->client->request(
            self::POST,
            self::ROUTES['saveProcess'],
            $params,
            $json_body_string ?? ''
        );
    }
}
