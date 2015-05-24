<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkEntryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel;

/**
 * Class LinkModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkModel extends NavigationLinksEntryModel implements LinkInterface
{

    /**
     * Eager load these relationships.
     *
     * @var array
     */
    protected $with = [
        'entry'
    ];

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl()
    {
        $entry = $this->getEntry();

        return $entry->getUrl();
    }

    /**
     * Get the type.
     *
     * @return LinkType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the related entry.
     *
     * @return LinkEntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        $entry = $this->getEntry();

        return $entry->getTitle();
    }
}
