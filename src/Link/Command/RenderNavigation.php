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
        $group = $this->dispatch(new GetGroup($this->options->get('group')));
        $links = $this->dispatch(new GetLinks($group, $this->options));

        return $view->make(
            $this->options->get('view', 'anomaly.module.navigation::links'),
            [
                'group'   => $group,
                'links'   => $links,
                'options' => $this->options
            ]
        )->render();
    }
}
