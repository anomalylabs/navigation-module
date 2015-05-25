<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\Command\SetActiveLinks;
use Anomaly\NavigationModule\Link\Command\SetCurrentLink;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Robbo\Presenter\Decorator;

/**
 * Class GetGroupLinks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Command
 */
class GetGroupLinks implements SelfHandling
{

    use DispatchesCommands;

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
     * Create a new GetGroupLinks instance.
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
     * @param Decorator $decorator
     * @return LinkCollection
     */
    public function handle(Decorator $decorator)
    {
        $links = $this->group->getLinks();

        $this->dispatch(new SetCurrentLink($links));
        $this->dispatch(new SetActiveLinks($links));

        return $decorator->decorate($links);
    }
}
