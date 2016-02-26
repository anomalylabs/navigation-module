<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class LinkCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkCollection extends EntryCollection
{

    /**
     * Alias for $this->top()
     *
     * @return LinkCollection
     */
    public function root()
    {
        return $this->top();
    }

    /**
     * Return only top level links.
     *
     * @return LinkCollection
     */
    public function top()
    {
        return $this->filter(
            function ($item) {

                /* @var LinkInterface $item */
                return !$item->getParentId();
            }
        );
    }

    /**
     * Return only children of the provided item.
     *
     * @param $parent
     * @return LinkCollection
     */
    public function children($parent)
    {
        /* @var LinkInterface $parent */
        return $this->filter(
            function ($item) use ($parent) {

                /* @var LinkInterface $item */
                return $item->getParentId() == $parent->getId();
            }
        );
    }

    /**
     * Return the current link.
     *
     * @return LinkInterface|null
     */
    public function current()
    {
        /* @var LinkInterface $item */
        foreach ($this->items as $item) {

            if ($item->isCurrent()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return only active links.
     *
     * @param bool $active
     * @return LinkCollection
     */
    public function active($active = true)
    {
        return $this->filter(
            function ($item) use ($active) {

                /* @var LinkInterface $item */
                return $item->isActive() == $active;
            }
        );
    }
}
