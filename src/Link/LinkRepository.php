<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;

/**
 * Class LinkRepository
 *
 * @package Anomaly\NavigationModule\Link
 */
class LinkRepository implements LinkRepositoryInterface
{

    /**
     * @var LinkModel
     */
    private $links;

    /**
     * @param LinkModel $links
     */
    public function __construct(LinkModel $links)
    {
        $this->links = $links;
    }

    /**
     * Find children links by a parent link slug.
     *
     * @param      $slug
     * @param int  $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection|array
     */
    public function findChildrenBySlug($slug, $maxDepth = 0, $showHidden = false)
    {
        return $this->links->findChildrenBySlug($slug, $maxDepth);
    }

    /**
     * Find children links by a parent link id.
     *
     * @param      $id
     * @param int  $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection
     */
    public function findChildren($id, $maxDepth = 0, $showHidden = false)
    {
        return $this->links->findChildren($id, $maxDepth);
    }

    /**
     * @param GroupInterface $group
     * @param int            $maxDepth
     * @param bool           $showHidden
     * @return EloquentCollection
     */
    public function findRootByGroup(GroupInterface $group, $maxDepth = 0, $showHidden = false)
    {
        return $this->links->findRootByGroup($group, $maxDepth, $showHidden);
    }

    /**
     * @param $id
     * @return LinkInterface
     */
    public function find($id)
    {
        return $this->links->find($id);
    }

    /**
     * @param $slug
     * @return LinkInterface
     */
    public function findBuSlug($slug)
    {
        return $this->links->findBySlug($slug);
    }

    /**
     * @return LinkInterface
     */
    public function getModel()
    {
        return $this->links;
    }
}