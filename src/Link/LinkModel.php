<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkEntryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Entry\EntryCollection;
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
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The current flag.
     *
     * @var bool
     */
    protected $current = false;

    /**
     * Eager load these relationships.
     *
     * @var array
     */
    protected $with = [
        'entry',
        'parent',
        'allowedRoles'
    ];

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl()
    {
        $entry = $this->getEntry();

        $url = $entry->getUrl();

        if (!starts_with($url, ['http://', 'https://', '//'])) {
            $url = url($url);
        }

        return $url;
    }

    /**
     * Get the type.
     *
     * @return Extension
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

    /**
     * Get the related allowed roles.
     *
     * @return EntryCollection
     */
    public function getAllowedRoles()
    {
        return $this->allowed_roles;
    }

    /**
     * Get the related parent.
     *
     * @return null|LinkInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the parent ID.
     *
     * @return null|int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Return the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the current flag.
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * Set the current flag.
     *
     * @param $current
     * @return $this
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }
}
