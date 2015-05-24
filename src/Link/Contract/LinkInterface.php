<?php namespace Anomaly\NavigationModule\Link\Contract;

use Anomaly\NavigationModule\Link\LinkType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface LinkInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Contract
 */
interface LinkInterface
{

    /**
     * Get the ID.
     *
     * @return null|int
     */
    public function getId();

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get the type.
     *
     * @return LinkType
     */
    public function getType();

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the related parent.
     *
     * @return null|LinkInterface
     */
    public function getParent();

    /**
     * Get the parent ID.
     *
     * @return null|int
     */
    public function getParentId();

    /**
     * Return the active flag.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active);

    /**
     * Get the current flag.
     *
     * @return bool
     */
    public function isCurrent();

    /**
     * Set the current flag.
     *
     * @param $current
     * @return $this
     */
    public function setCurrent($current);
}
