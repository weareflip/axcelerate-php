<?php

namespace FlipNinja\Axcelerate\Courses;

use FlipNinja\Axcelerate\Manager;
use FlipNinja\Axcelerate\ManagerContract;
use FlipNinja\Axcelerate\Exceptions\AxcelerateException;

class CourseManager extends Manager implements ManagerContract
{
    /**
     * Find an instance with attributes
     *
     * @throws AxcelerateException if multiple instances are found
     * @param array $attributes Attributes to match with
     * @return Instance|null
     */
    public function findInstance($attributes)
    {
        $instances = $this->searchInstances($attributes);

        if (count($instances) > 1) {
            throw new AxcelerateException('Search attributes were not specific enough to find a single instance.');
        }

        return $instances ? $instances[0] : null;
    }

    /**
     * Search for instances that match the attributes
     *
     * @param array $attributes Attributes to match with
     * @return Instance[]
     */
    public function searchInstances($attributes)
    {
        // Default search parameters
        $defaults = [
            'startDate_min' => date('Y-m-d', time() - 3153600000), // 100 years ago
            'startDate_max' => date('Y-m-d', time() + 3153600000), // 100 years from now
            'finishDate_min' => date('Y-m-d', time() - 3153600000), // 100 years ago
            'finishDate_max' => date('Y-m-d', time() + 3153600000), // 100 years from now
            'everything' => true // A lovely parameter that overwrites the defaults
        ];

        $instances = [];

        if ($response = $this->getConnection()->post('course/instance/search', array_merge($defaults, $attributes))) {
            foreach ($response as $instance) {
                $instances[] = new Instance($instance, $this);
            }
        }

        return $instances;
    }

    /**
     * Get all courses in axcelerate.
     *
     * @return array
     */
    public function get()
    {
        return $this->getConnection()->get('courses/', []);
    }
}
