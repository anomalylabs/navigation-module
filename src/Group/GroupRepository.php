<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;

/**
 * Class GroupRepository
 *
 * @package Anomaly\NavigationModule\Group
 */
class GroupRepository implements GroupRepositoryInterface
{

    /**
     * @var \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected $all;

    /**
     * @var GroupModel
     */
    private $groups;

    /**
     * @param GroupModel $groups
     */
    public function __construct(GroupModel $groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->all ?: $this->groups->orderBy('title')->get();
    }

    /**
     * @param null $slug
     * @return GroupModel
     */
    public function active($slug = null)
    {
        if (!($group = $this->groups->findBySlug($slug))) {
            $group = $this->all()->first();
        }

        return $group;
    }

    /**
     * @param $slug
     * @return GroupModel
     */
    public function findBySlug($slug)
    {
        return $this->groups->findBySlug($slug);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        /** @var GroupModel $group */
        $group = $this->groups->find($id);

        return $group ? $group->delete() : false;
    }

    /**
     * @param $id
     * @param $maxDepth
     * @return mixed
     */
    public function updateMaxDepth($id, $maxDepth)
    {
        return $this->groups->where('id', $id)->update(['max_depth' => $maxDepth]);
    }
}