<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LinkModel
 * @package Anomaly\NavigationModule\Link
 */
class LinkModel extends NavigationLinksEntryModel implements LinkInterface
{

    protected $titleName = 'title';

    /**
     * @param $slug
     * @return LinkInterface
     */
    public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Find children links by a parent link slug.
     *
     * @param $slug
     * @param int $maxDepth
     * @return array|EloquentCollection
     */
    public function findChildrenBySlug($slug, $maxDepth = 0, $showHidden = false)
    {
        $children = [];
        /** @var LinkInterface $link */
        if ($link = $this->where('slug', $slug)->first(['id', 'slug'])) {
            $children = $this->findChildren($link->getKey(), $maxDepth ?: $link->getMaxDepth());
        }
        return $children;
    }

    /**
     * Find children links by a parent link id.
     *
     * @param $id
     * @param int $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection
     */
    public function findChildren($id, $maxDepth = 0, $showHidden = false)
    {
        $eager = array_merge(
            ['linkable'],
            $this->getEagerArrayByDepth($maxDepth, 'linkable'),
            [$this->getEagerChildren($maxDepth)]
        );

        $query = $this
            ->with($eager)
            ->where('parent_id', $id)
            ->orderBy('sort_order');

        if (!$showHidden) {
            $query->where('hidden', false);
        }

        return $query->get();
    }

    /**
     * @param GroupInterface $group
     * @param int $maxDepth
     * @param bool $showHidden
     * @return EloquentCollection
     */
    public function findRootByGroup(GroupInterface $group, $maxDepth = 0, $showHidden = false)
    {
        $maxDepth = $maxDepth ?: $group->getMaxDepth();

        $eager = array_merge(
            ['linkable'],
            $this->getEagerArrayByDepth($maxDepth, 'linkable'),
            [$this->getEagerChildren($maxDepth)]
        );

        $query = $this
            ->with($eager)
            ->whereNull('parent_id')
            ->where('group_id', $group->getKey())
            ->orderBy('sort_order');

        if (!$showHidden) {
            $query->where('hidden', false);
        }

        return $query->get();
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id')->orderBy('sort_order');
    }

    /**
     * Get the link ancestors
     *
     * @return EloquentCollection
     */
    public function ancestors()
    {
        $ancestors = [];

        if ($parent = $this->parent) {

            $ancestors[] = $parent;

            while ($parent->parent) {
                $ancestors[] = $parent = $parent->parent;
            }
        }

        return $this->newCollection($ancestors)->reverse();
    }

    /**
     * The max depth of children to be eager loaded.
     *
     * @return int
     */
    public function getMaxDepth()
    {
        return $this->getAttribute('max_depth');
    }

    /**
     * Get the nested children eager load string.
     *
     * @param $eagerDepth
     * @return string
     */
    protected function getEagerChildren($eagerDepth)
    {
        $eager = [];

        foreach (range(0, $eagerDepth) as $n) {
            $eager[] = 'children';
        }

        return implode('.', $eager);
    }

    /**
     * Get the nested group eager loads array.
     *
     * @param $eagerDepth
     * @param $nested
     * @return string
     */
    protected function getEagerArrayByDepth($eagerDepth, $nested)
    {
        $eager = [];

        foreach (range(0, $eagerDepth) as $n) {
            $eager[] = str_repeat('children.', $n) . "children.{$nested}";
        }

        return $eager;
    }

}