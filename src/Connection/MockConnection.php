<?php

namespace FlipNinja\Axcelerate\Connection;

class MockConnection implements ConnectionContract
{
    /** @var mixed $response */
    protected $response;

    public function __construct()
    {
        // @TODO The constructor should be part of the interface?
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

    public function create($path, $attributes)
    {
        return $this->response;
    }

    public function get($path, $params = [])
    {
        return $this->response;
    }

    public function post($path, $params = [])
    {
        return $this->response;
    }

    public function update($path, $attributes)
    {
        return $this->response;
    }
}
