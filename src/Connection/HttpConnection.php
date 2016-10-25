<?php

namespace FlipNinja\Axcelerate\Connection;

use FlipNinja\Axcelerate\Connection\ConnectionContract;
use FlipNinja\Axcelerate\Exceptions\AxcelerateException;
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
        } catch (RequestException $e) {
            $error = $this->parseError($e);

            throw new AxcelerateException($error->title, $error->code, $error->detail);
        } catch (TransferException $e) {
            throw new AxcelerateException($e->getMessage(), $e->getCode());
        }

        return $this->decodeResponse($response);
    }

    protected function parseError(RequestException $e)
    {
        if ($e->hasResponse() && $response = $this->decodeResponse($e->getResponse())) {
            return (object) [
                'title' => array_key_exists('MESSAGES', $response) ? $response['MESSAGES'] : '',
                'code' => array_key_exists('CODE', $response) ? intval($response['CODE']) : 500,
                'detail' => array_key_exists('DETAILS', $response) ? $response['DETAILS'] : ''
            ];
        }

        return (object) [
            'title' => $e->getMessage(),
            'code' => $e->getCode(),
            'detail' => ''
        ];
    }

    /**
     * JSON Decodes Response body
     *
     * @return array
     */
    protected function decodeResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
