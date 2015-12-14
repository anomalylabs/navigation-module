<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Command\DeleteGroupLinks;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class GroupObserver
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group
 */
class GroupObserver extends EntryObserver
{

    /**
     * Fired after an entry is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new DeleteGroupLinks($entry));

        parent::deleted($entry);
    }
}
