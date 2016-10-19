<?php

namespace Flip\Axcelerate;

use Flip\Axcelerate\ConnectionContract;

interface ManagerContract
{
    public function getConnection();

    public function setConnection(ConnectionContract $connection);
}
