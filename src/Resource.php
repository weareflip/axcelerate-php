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
        $this->attributes = $this->deAxcelerateAttributes($attributes);

        // Set ID if exists
        if ($this->idAttribute && array_key_exists($this->idAttribute, $this->attributes)) {
            $this->id = $this->attributes[$this->idAttribute];
        }
    }

    /**
     * Recursively lowers the case of array keys
     *
     * @param array $attributes
     * @return array
     */
    public function deAxcelerateAttributes($attributes)
    {
        return array_map(function($item) {
            if (is_array($item)) {
                $item = $this->deAxcelerateAttributes($item);
            }
            return $item;
        }, array_change_key_case($attributes));
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
