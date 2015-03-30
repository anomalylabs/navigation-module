<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\Streams\Platform\Model\Navigation\NavigationGroupsEntryModel;


class GroupModel extends NavigationGroupsEntryModel
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


}