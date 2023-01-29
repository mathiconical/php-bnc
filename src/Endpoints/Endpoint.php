<?php

namespace Mathiconical\PhpBnc\Endpoints;

abstract class Endpoint
{
    public const ROUTES = [
        'saveProcess' => 'Process/SaveProcess/',
        'removeProcess' => 'Process/RemoveProcess/',
        // 'removeLote' => 'Process/RemoveBatches/',
        // 'saveItem' => 'Process/SaveBatches/',
        'result' => 'Process/GetProcessResult/',
        'guid' => 'Process/GetProcessId/',
        'status' => 'Process/GetProcessStatus/',
    ];

    public const POST = 'POST';

    public const GET = 'GET';

    /**
     * @var \Mathiconical\PhpBnc\Client
     */
    protected $client;

    /**
     * @param \Mathiconical\PhpBnc\Client $client
     */
    public function __construct(\Mathiconical\PhpBnc\Client $client)
    {
        $this->client = $client;
    }
}
