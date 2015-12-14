<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class LinkCollection
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
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
     * Return the active link.
     *
     * @return LinkInterface|null
     */
    public function active()
    {
        /* @var LinkInterface $item */
        foreach ($this->items as $item) {

            if ($item->isActive()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return whether the provided
     * link has an active child.
     *
     * @param $parent
     * @return bool
     */
    public function hasActive($parent)
    {
        /* @var LinkInterface $item */
        foreach ($this->items as $item) {

            /* @var LinkInterface $parent */
            if ($item->isActive() && $item->getParentId() == $parent->getId()) {
                return true;
            }

            $children = $this->children($parent);

            if ($children->isEmpty()) {
                continue;
            }

            foreach ($children as $child) {
                if ($this->hasActive($child)) {
                    return true;
                }
            }
        }

        return false;
    }
}
