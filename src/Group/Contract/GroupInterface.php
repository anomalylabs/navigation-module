<?php namespace Anomaly\NavigationModule\Group\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;

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

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the related links.
     *
     * @return LinkCollection
     */
    public function getLinks();

    /**
     * Return the links relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links();
}
