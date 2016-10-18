<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\Exceptions\ConnectionException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

class HttpConnection
{
    protected $client;

    public function __construct($base_uri, $wstoken, $apitoken)
    {
        try {
            $this->client = new Client(compact('base_uri', 'wstoken', 'apitoken'));
        } catch (ConnectionException $e) { }
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
            'json' => $data
        ];

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (ClientException $e) {
            // 4XX
        } catch (ServerException $e) {
            // 5XX
        } catch (RequestException $e) {
            // Network
        }

        return json_decode($response->getBody()->getContents());
    }
}
