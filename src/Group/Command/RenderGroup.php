<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\Command\SetActiveLinks;
use Anomaly\NavigationModule\Link\Command\SetCurrentLink;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderGroup
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Command
 */
class RenderGroup implements SelfHandling
{

    use DispatchesJobs;

    /**
     * The group to render.
     *
     * @var GroupInterface
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
     * @param GroupInterface $group
     * @param array          $options
     */
    function __construct(GroupInterface $group, array $options = [])
    {
        $this->group   = $group;
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @return string
     */
    public function handle()
    {
        $group   = $this->group;
        $options = $this->options;

        $links = $this->group->getLinks();

        $this->dispatch(new SetCurrentLink($links));
        $this->dispatch(new SetActiveLinks($links));

        return view('anomaly.module.navigation::links', compact('group', 'links', 'options'))->render();
    }
}
