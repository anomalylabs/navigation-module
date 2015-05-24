<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\Streams\Platform\Model\Navigation\NavigationGroupsEntryModel;

/**
 * Class GroupModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group
 */
class GroupModel extends NavigationGroupsEntryModel implements GroupInterface
{

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
