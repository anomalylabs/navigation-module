<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Command\DeleteChildLinks;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class LinkObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkObserver extends EntryObserver
{

    /**
     * Fired after a link is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->commands->dispatch(new DeleteChildLinks($entry));

        parent::deleted($entry);
    }
}
