<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Group\Command\GetGroup;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderNavigation
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class RenderNavigation implements SelfHandling
{

    use DispatchesJobs;

    /**
     * The rendering options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new RenderNavigation instance.
     *
     * @param Collection $options
     */
    function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @param Factory $view
     * @return null|string
     */
    public function handle(Factory $view)
    {
        $options = $this->options;

        $group = $this->dispatch(new GetGroup($options->get('group')));

        if ($group) {
            $links = $group->getLinks();
        } else {
            $links = $options->get('links');
        }

        if (!$links) {
            return null;
        }

        if ($root = $options->get('root')) {
            if ($link = $this->dispatch(new GetParentLink($root, $links))) {
                $options->put('parent', $link);
            }
        }

        $this->dispatch(new RemoveRestrictedLinks($links));
        $this->dispatch(new SetParentRelations($links));
        $this->dispatch(new SetActiveLink($links));

        return $view->make(
            $options->get('view', 'anomaly.module.navigation::links'),
            compact('group', 'links', 'options')
        )->render();
    }
}
