<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\Connection\ConnectionContract;

interface ManagerContract
{
    /**
     * @return ConnectionContract
     */
    public function getConnection();

    public function setConnection(ConnectionContract $connection);
}
