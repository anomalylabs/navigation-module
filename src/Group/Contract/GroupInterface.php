<?php namespace Anomaly\NavigationModule\Group\Contract;

/**
 * Interface GroupInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Contract
 */
interface GroupInterface
{

    /**
     * Get the ID.
     *
     * @return null|int
     */
    public function getId();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();
}
