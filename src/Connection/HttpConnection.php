<?php

namespace Flip\Axcelerate\Connection;

use Flip\Axcelerate\Connection\ConnectionContract;
use Flip\Axcelerate\Exceptions\AxcelerateException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;

class HttpConnection implements ConnectionContract
{
    /** @var Client $client */
    protected $client;

    public function __construct($base_uri, $apitoken,  $wstoken)
    {
        $headers = compact('apitoken', 'wstoken');

        $this->client = new Client(compact('base_uri', 'headers'));
    }

    public function create($path, $data = [])
    {
        return $this->request($path, 'POST', $data);
    }

    public function get($path)
    {
        return $this->request($path, 'GET');
    }

    public function update($path, $data)
    {
        return $this->request($path, 'PUT', $data);
    }

    protected function request($path, $method, $data = [])
    {
        $options = [
            'form_params' => $data
        ];

        try {
            $response = $this->client->request($method, $path, $options);
        } catch (RequestException $e) {
            $error = $this->parseError($e);
            throw new AxcelerateException($error->title, $error->code, $error->detail);
        } catch (TransferException $e) {
            throw new AxcelerateException($e->getMessage(), $e->getCode());
        }

        return $this->extractResponseJson($response);
    }

    protected function parseError(RequestException $e)
    {
        if ($e->hasResponse() && $response = $this->extractResponseJson($e->getResponse())) {
            return (object) [
                'title' => $response->messages,
                'code' => $response->code,
                'detail' => $response->details
            ];
        }

        return (object) [
            'title' => $e->getMessage(),
            'code' => $e->getCode(),
            'detail' => ''
        ];
    }

    public function extractResponseJson(ResponseInterface $response)
    {
        $body = json_decode($response->getBody()->getContents(), true);

        return $body ? (object) array_change_key_case($body) : false;
    }
}
