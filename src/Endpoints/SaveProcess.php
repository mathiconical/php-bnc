<?php

namespace Mathiconical\PhpBnc\Endpoints;

use Mathiconical\PhpBnc\Endpoints\Endpoint;

class SaveProcess extends Endpoint
{
    /**
     * @param array $options
     * @param array $body
     * @throws \Exception
     * @return \ArrayObject
     */
    public function save(array $options = [], array $body = [])
    {
        $json_body_string = json_encode($body);

        return $this->client->request(
            self::POST,
            self::ROUTES['saveProcess'],
            $options,
            $json_body_string ?? ''
        );
    }
}
