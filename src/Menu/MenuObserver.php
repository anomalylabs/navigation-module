<?php namespace Anomaly\NavigationModule\Menu;

use Anomaly\NavigationModule\Menu\Command\DeleteMenuLinks;
use Anomaly\NavigationModule\Menu\Command\RestoreMenuLinks;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class MenuObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MenuObserver extends EntryObserver
{

    /**
     * Fired after an entry is deleted.
     *
     * @param EntryInterface|MenuInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new DeleteMenuLinks($entry));

        parent::deleted($entry);
    }

    /**
     * Fired after an entry has been restored.
     *
     * @param EntryInterface|MenuInterface $entry
     */
    public function restored(EntryInterface $entry)
    {
        $this->dispatch(new RestoreMenuLinks($entry));

        parent::restored($entry);
    }
}
