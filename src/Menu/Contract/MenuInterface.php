<?php namespace Anomaly\NavigationModule\Menu\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface MenuInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Menu\Contract
 */
interface MenuInterface extends EntryInterface
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
