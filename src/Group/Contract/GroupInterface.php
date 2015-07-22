<?php namespace Anomaly\NavigationModule\Group\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface GroupInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Contract
 */
interface GroupInterface extends EntryInterface
{

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
}
