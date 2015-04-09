<?php namespace Anomaly\NavigationModule\Group\Contract;


interface GroupInterface
{

    /**
     * Get the group id
     *
     * @return int
     */
    public function getKey();

    /**
     * Get the group max depth
     *
     * @return int
     */
    public function getMaxDepth();
}