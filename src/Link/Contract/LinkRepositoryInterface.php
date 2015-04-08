<?php namespace Anomaly\NavigationModule\Link\Contract;


use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;

interface LinkRepositoryInterface
{

    /**
     * @param $id
     * @return LinkInterface
     */
    public function find($id);

    /**
     * @param $slug
     * @return LinkInterface
     */
    public function findBuSlug($slug);

    /**
     * Find children links by a parent link slug.
     *
     * @param $slug
     * @param int $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection|array
     */
    public function findChildrenBySlug($slug, $maxDepth = 0, $showHidden = false);

    /**
     * Find children links by a parent link id.
     *
     * @param $id
     * @param int $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection
     */
    public function findChildren($id, $maxDepth = 0, $showHidden = false);

    /**
     * @param GroupInterface $group
     * @param int $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection
     */
    public function findRootByGroup(GroupInterface $group, $maxDepth = 0, $showHidden = false);

    /**
     * @return LinkInterface
     */
    public function getModel();
}