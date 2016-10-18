<?php

namespace Flip\Axcelerate;

abstract class AxcelerateResource
{
    protected $manager;

    protected $attributes;

    public function __construct($manager, $attributes)
    {
        $this->manager = $manager;
        $this->attributes = $attributes;
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function __toString()
    {
        return $this->toJson();
    }
}