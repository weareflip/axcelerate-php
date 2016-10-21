<?php

namespace FlipNinja\Axcelerate;

abstract class Resource
{
    /** @var int $id The resource's ID */
    public $id;

    /** @var string $idAttribute Attribute to automatically assigned to ID */
    public $idAttribute;

    /** @var array $attributes */
    protected $attributes;

    /** @var ManagerContract $manager Resource's manager */
    protected $manager;

    /**
     * @param array $attributes
     * @param ManagerContract $manager
     */
    public function __construct($attributes, ManagerContract $manager)
    {
        $this->manager = $manager;
        $this->attributes = $attributes;

        // Set ID if exists
        if ($this->idAttribute && array_key_exists($this->idAttribute, $attributes)) {
            $this->id = $attributes[$this->idAttribute];
        }
    }

    /**
     * Convert to array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * Convert to JSON
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert to string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
