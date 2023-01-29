<?php

namespace Mathiconical\PhpBnc;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Mathiconical\PhpBnc\Endpoints\GetProcessGuid;
use Mathiconical\PhpBnc\Endpoints\GetProcessResult;
use Mathiconical\PhpBnc\Endpoints\RemoveProcess;
use Mathiconical\PhpBnc\Endpoints\SaveProcess;
use Mathiconical\PhpBnc\Endpoints\StatusProcess;
use Mathiconical\PhpBnc\Endpoints\ResponseHandler;

class Client
{
    /**
     * Associative Array with URI options.
     * TEST - URI TEST
     * PROD - URI PRODUCTION
     * @var array
     */
    public const BASE_URI = [
        'TEST' => 'https://tiprointegprocess.azurewebsites.net/api/',
        'PROD' => 'https://bncrestinteg.azurewebsites.net/api/',
    ];

    /**
     * @var HttpClient
     */
    private $http;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var SaveProcess
     */
    private $saveProcess;

    /**
     * @var RemoveProcess
     */
    private $removeProcess;

    /**
     * @var StatusProcess
     */
    private $statusProcess;

    /**
     * @var GetProcessGuid
     */
    private $getProcessGuid;

    /** @var GetProcessResult */
    private $getProcessResult;

    /**
     * $target pode ser TEST para servidor de testes ou PROD para produção.
     * @param string $apiKey
     * @param array|null $extras
     * @param string $target
     */
    public function __construct(string $apiKey, array $extras = null, string $target = 'TEST')
    {
        $this->apiKey = $apiKey;

        $options = ['base_uri' => self::BASE_URI[$target]];

        if (!is_null($extras)) {
            $options = array_merge($options, $extras);
        }

        $this->http = new HttpClient($options);

        $this->saveProcess = new SaveProcess($this);
        $this->removeProcess = new RemoveProcess($this);
        $this->statusProcess = new StatusProcess($this);
        $this->getProcessGuid = new GetProcessGuid($this);
        $this->getProcessResult = new GetProcessResult($this);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @throws \Exception
     * @return \ArrayObject
     */
    public function request(string $method, string $uri, array $options = [], string $json_string = '')
    {
        try {
            $response = $this->http->request(
                $method,
                $uri . $this->arrayToUriParam($options),
                [
                    'body' => $json_string,
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]
                ]
            );

            return ResponseHandler::success((string)$response->getBody());
        } catch (Exception $e) {
            throw $e;
        } catch (ClientException $ce) {
            throw $ce;
        }
    }

    /**
     * Converte array associativo em parametros para URI.
     * ['postId' => 1, 'userId' => 2] -> ?postId=1&?userId=2
     * @param array $options
     * @return string|void
     */
    public function arrayToUriParam(array $options = [])
    {
        if (!count($options)) {
            return '';
        }

        $flattened = $options;
        array_walk($flattened, function (&$value, $key) {
            $value = "?{$key}={$value}";
        });

        return implode('&', $flattened);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return SaveProcess
     */
    public function getSaveProcess()
    {
        return $this->saveProcess;
    }

    /**
     * @return RemoveProcess
     */
    public function getRemoveProcess()
    {
        return $this->removeProcess;
    }

    /**
     * @return StatusProcess
     */
    public function getStatusProcess()
    {
        return $this->statusProcess;
    }

    /**
     * @return GetProcessGuid
     */
    public function getProcessGuid()
    {
        return $this->getProcessGuid;
    }

    /**
     * @return GetProcessGuid
     */
    public function getProcessResult()
    {
        return $this->getProcessResult();
    }
}
