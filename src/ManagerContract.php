<?php

namespace FlipNinja\Axcelerate;

use FlipNinja\Axcelerate\Connection\ConnectionContract;

interface ManagerContract
{
    /**
     * @return ConnectionContract
     */
    public function getConnection();

    public function setConnection(ConnectionContract $connection);
}
