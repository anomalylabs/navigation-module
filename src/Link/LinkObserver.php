<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Command\UnsetChildLinks;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class LinkObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkObserver extends EntryObserver
{

    /**
     * Fired after an entry is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new UnsetChildLinks($entry));

        parent::deleted($entry);
    }
}
