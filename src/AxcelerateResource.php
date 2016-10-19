<?php

namespace Flip\Axcelerate;

abstract class AxcelerateResource
{
    public $id;

    public $idAttribute;

    protected $manager;

    protected $attributes;

    public function __construct($attributes, ManagerContract $manager)
    {
        $this->manager = $manager;
        $this->attributes = $attributes;

        // Set ID if exists
        if ($this->idAttribute && array_key_exists($this->idAttribute, $attributes)) {
            $this->id = $attributes[$this->idAttribute];
        }
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
