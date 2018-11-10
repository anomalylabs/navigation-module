<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Command\PurgeCache;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class LinkObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LinkObserver extends EntryObserver
{

    /**
     * Fired just after saving the entry.
     *
     * @param EntryInterface|LinkInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        $this->dispatch(new PurgeCache($entry));

        return parent::saved($entry);
    }

}
