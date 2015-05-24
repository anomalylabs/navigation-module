<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Group\Command\RenderGroup;
use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesCommands;

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

    use DispatchesCommands;

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
     * @return string
     */
    public function render($group, $options = [])
    {
        return $this->dispatch(new RenderGroup($this->groups->findBySlug($group), $options));
    }
}
