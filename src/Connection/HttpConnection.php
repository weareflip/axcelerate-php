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

    public function create($path, $attributes)
    {
        return $this->request($path, 'POST', [
            'form_params' => $attributes
        ]);
    }

    public function get($path, $params)
    {
        return $this->request($path, 'GET', [
            'query' => $params
        ]);
    }

    public function post($path, $params)
    {
        return $this->request($path, 'POST', [
            'query' => $params
        ]);
    }

    public function update($path, $attributes)
    {
        return $this->request($path, 'PUT', [
            'form_params' => $attributes
        ]);
    }

    protected function request($path, $method, $options = [])
    {
        try {
            $response = $this->client->request($method, $path, $options);
            if ($method == 'POST') {
                var_dump($response->getBody()->getContents());
            }
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

        return $body ? array_filter(array_change_key_case($body)) : false;
    }
}
