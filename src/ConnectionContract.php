<?php

namespace Flip\Axcelerate;

interface ConnectionContract
{
    public function create($path, $attributes);

    public function get($path);

    public function update($path, $attributes);
}
