<?php

namespace Flip\Axcelerate\Connection;

use Flip\Axcelerate\Connection\ConnectionContract;

class MockConnection implements ConnectionContract
{
    /** @var mixed $response */
    protected $response;

    public function __construct($base_uri, $apitoken,  $wstoken)
    {
        // @TODO The constructor should be part of the interface
    }

    /**
     * Set what the connection will return for responses
     * A JSON object is typical
     *
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function create($path, $data = [])
    {
        return $this->response;
    }

    public function get($path)
    {
        return $this->response;
    }

    public function update($path, $data)
    {
        return $this->response;
    }
}
