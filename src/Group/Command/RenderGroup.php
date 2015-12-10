<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderGroup
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Command
 */
class RenderGroup implements SelfHandling
{

    use DispatchesJobs;

    /**
     * The group to render.
     *
     * @var string
     */
    protected $group;

    /**
     * The rendering options.
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new RenderGroup instance.
     *
     * @param       $group
     * @param array $options
     */
    function __construct($group, array $options = [])
    {
        $this->group   = $group;
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @return string
     */
    public function handle(GroupRepositoryInterface $groups, Factory $view)
    {
        if (!$group = $groups->findBySlug($this->group)) {
            return null;
        }

        $options = $this->options;

        $links = $group->getLinks();

        $this->dispatch(new RemoveRolesLinks($links));
        $this->dispatch(new SetCurrentLink($group));

        return $view->make(
            array_get($options, 'view', 'anomaly.module.navigation::links'),
            compact('group', 'links', 'options')
        )->render();
    }
}
