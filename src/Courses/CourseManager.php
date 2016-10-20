<?php

namespace Flip\Axcelerate\Courses;

use Flip\Axcelerate\Manager;
use Flip\Axcelerate\ManagerContract;
use Flip\Axcelerate\Courses\Instance;
use Flip\Axcelerate\Exceptions\AxcelerateException;

class CourseManager extends Manager implements ManagerContract
{
    /**
     * Find an instance with attributes
     *
     * @param array $attributes Attributes to match with
     * @return Instance|null
     */
    public function findInstance($attributes)
    {
        $instances = $this->searchForInstances($attributes);

        if (count($instances) > 1) {
            throw new AxcelerateException('Search attributes were not specific enough to find a single instance.');
        }

        return $instances ? new $instances[0] : null;
    }

    /**
     * Search for instances that match the attributes
     *
     * @param array $attributes Attributes to match with
     * @return Instance[]
     */
    public function searchForInstances($attributes)
    {
        $instances = [];

        $response = $this->getConnection()->post('course/instance/search', $attributes);

        if (!$response) {
            return [];
        }

        foreach ($response as $instance) {
            $instances[] = new Instance($instance, $this);
        }

        return $instances;
    }
}
