<?php

declare(strict_types=1);

namespace Mathiconical\PhpBnc;

use Exception;
use Mathiconical\PhpBnc\Endpoints\Endpoint;
use Mathiconical\PhpBnc\Endpoints\SaveProcess;
use Mathiconical\PhpBnc\ResponseHandler;
use Mathiconical\PhpBnc\Endpoints\GetProcessGuid;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    /** @var string */
    private $apikey;

    /** @var Client */
    private $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->apikey = 'YOUR_API_KEY';
        $this->client = new Client($this->apikey);
    }

    public function testApiKey()
    {
        $this->assertEquals($this->apikey, $this->client->getApiKey());
    }

    public function testClassInstance()
    {
        $this->assertInstanceOf('Mathiconical\PhpBnc\Client', $this->client);
        $this->assertInstanceOf('Mathiconical\PhpBnc\Endpoints\SaveProcess', $this->client->getSaveProcess());
        $this->assertInstanceOf('Mathiconical\PhpBnc\Endpoints\RemoveProcess', $this->client->getRemoveProcess());
        $this->assertInstanceOf('Mathiconical\PhpBnc\Endpoints\StatusProcess', $this->client->getStatusProcess());
        $this->assertInstanceOf('Mathiconical\PhpBnc\Endpoints\GetProcessGuid', $this->client->getProcessGuid());
    }

    public function testGetProcessGuidSuccess()
    {
        $response = ($this->client->getProcessGuid())->get(['param' => '2308']);

        $this->assertIsString($response);
    }

    public function testGetProcessStatus()
    {
        $guid = ($this->client->getProcessGuid())->get(['param' => '2308']);

        $response = ($this->client->getStatusProcess())->get(['processId' => $guid]);

        $this->assertInstanceOf('stdClass', $response);

        $obj_keys = get_object_vars($response);

        $this->assertArrayHasKey('idStatus', $obj_keys);
        $this->assertArrayHasKey('Status', $obj_keys);
    }
}
