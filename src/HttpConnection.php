<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\Exceptions\AxcelerateException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;

class HttpConnection
{
    protected $client;

    public function __construct($base_uri, $apitoken,  $wstoken)
    {
        $headers = compact('apitoken', 'wstoken');

        $this->client = new Client(compact('base_uri', 'headers'));
    }

    public function create($resourceUrl, $data = [])
    {
        return $this->request($resourceUrl, 'POST', $data);
    }

    public function get($resourceUrl)
    {
        return $this->request($resourceUrl, 'GET');
    }

    public function update($resourceUrl, $data)
    {
        return $this->request($resourceUrl, 'PUT', $data);
    }

    protected function request($uri, $method, $data = [])
    {
        $response = null;

        $options = [
            'form_params' => $data
        ];

        try {
            $response = $this->client->request($method, $uri, $options);
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
