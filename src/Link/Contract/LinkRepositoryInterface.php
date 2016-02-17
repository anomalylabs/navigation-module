<?php namespace Anomaly\NavigationModule\Link\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface LinkRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Contract
 */
interface LinkRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Return links belonging to
     * the provided menu.
     *
     * @param MenuInterface $menu
     * @return LinkCollection
     */
    public function findAllByMenu(MenuInterface $menu);
}
