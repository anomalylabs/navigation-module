<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class GroupPresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group
 */
class GroupPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var GroupInterface|EntryInterface
     */
    protected $object;

    /**
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        return app('html')->link('admin/navigation/links/' . $this->object->getSlug(), $this->object->getTitle());
    }
}
