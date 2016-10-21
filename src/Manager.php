<?php

namespace FlipNinja\Axcelerate;

use FlipNinja\Axcelerate\Connection\ConnectionContract;

abstract class Manager
{
    /** @var ConnectionContract $connection */
    protected $connection;

    /**
     * @param ConnectionContract $connection
     */
    public function __construct(ConnectionContract $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Set connection interface
     *
     * @param ConnectionContract $connection
     */
    public function setConnection(ConnectionContract $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get connection interface
     *
     * @return ConnectionContract
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
