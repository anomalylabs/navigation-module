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
     * Return only root items.
     *
     * @return LinkCollection
     */
    public function root()
    {
        $root = [];

        /* @var LinkInterface $item */
        foreach ($this->items as $item) {
            if (!$item->getParent()) {
                $root[] = $item;
            }
        }

        return new static($root);
    }

    /**
     * Return only children of the provided item.
     *
     * @param LinkInterface $parent
     * @return LinkCollection
     */
    public function children(LinkInterface $parent)
    {
        $children = [];

        /* @var LinkInterface $item */
        foreach ($this->items as $item) {
            if ($item->getParentId() == $parent->getId()) {
                $children[] = $item;
            }
        }

        return new static($children);
    }

    /**
     * Return the current link.
     *
     * @return LinkInterface
     */
    public function current()
    {
        /* @var LinkInterface $item */
        foreach ($this->items as $item) {
            /*if ($item->isCurrent()) {
                return $item;
            }*/
        }

        return null;
    }
}
