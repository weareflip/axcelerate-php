<?php

namespace Flip\Axcelerate\Connection;

interface ConnectionContract
{
    public function create($path, $attributes);

    public function get($path, $params);

    public function update($path, $attributes);
}
