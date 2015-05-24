<?php namespace Anomaly\NavigationModule\Link\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface LinkEntryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Contract
 */
interface LinkEntryInterface extends EntryInterface
{

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl();
}
