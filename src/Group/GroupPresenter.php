<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Command\GetActiveGroup;
use Anomaly\Streams\Platform\Model\EloquentPresenter;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class GroupPresenter
 * @package Anomaly\NavigationModule\Group
 */
class GroupPresenter extends EloquentPresenter
{
    use DispatchesCommands;

    public function presentAdminUrl()
    {
        return route('admin.navigation', ['group' => $this->object->slug]);
    }

    public function presentActive()
    {
        $activeGroup = $this->dispatch(new GetActiveGroup());
        return ($this->object->slug == $activeGroup->slug) ? 'active' : null;
    }

}