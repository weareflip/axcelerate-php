<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\ConnectionContract;

interface ManagerContract
{
    /**
     * @return ConnectionContract
     */
    public function getConnection();

    public function setConnection(ConnectionContract $connection);
}
