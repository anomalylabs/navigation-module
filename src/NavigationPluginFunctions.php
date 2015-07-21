<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Group\Command\GetGroupLinks;
use Anomaly\NavigationModule\Group\Command\RenderGroup;
use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class NavigationPluginFunctions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationPluginFunctions
{

    use DispatchesJobs;

    /**
     * The group repository.
     *
     * @var GroupRepositoryInterface
     */
    protected $groups;

    /**
     * Create a new NavigationPluginFunctions instance.
     *
     * @param GroupRepositoryInterface $groups
     */
    public function __construct(GroupRepositoryInterface $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Render a navigation group.
     *
     * @param       $group
     * @param array $options
     * @return null|string
     */
    public function render($group, $options = [])
    {
        if (!$group = $this->groups->findBySlug($group)) {
            return null;
        }

        return $this->dispatch(new RenderGroup($group, $options));
    }

    /**
     * Return the processed links for a group.
     *
     * @param       $group
     * @return null|LinkCollection
     */
    public function links($group)
    {
        if (!$group = $this->groups->findBySlug($group)) {
            return null;
        }

        return $this->dispatch(new GetGroupLinks($group));
    }
}
