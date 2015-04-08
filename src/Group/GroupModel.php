<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\Streams\Platform\Model\Navigation\NavigationGroupsEntryModel;


class GroupModel extends NavigationGroupsEntryModel implements GroupInterface
{

    /**
     * @var string
     */
    protected $titleName = 'title';

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * @return mixed
     */
    public function getMaxDepth()
    {
        return $this->getAttribute('max_depth');
    }

}