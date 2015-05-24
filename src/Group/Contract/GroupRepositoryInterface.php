<?php namespace Anomaly\NavigationModule\Group\Contract;

/**
 * Interface GroupRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Contract
 */
interface GroupRepositoryInterface
{

    /**
     * Find a group by it's slug.
     *
     * @param $slug
     * @return null|GroupInterface
     */
    public function findBySlug($slug);
}
