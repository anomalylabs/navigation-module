<?php namespace Anomaly\NavigationModule\Menu\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface MenuInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
