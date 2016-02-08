<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetLinks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class GetLinks implements SelfHandling
{

    use DispatchesJobs;

    /**
     * The group object.
     *
     * @var GroupInterface
     */
    protected $group;

    /**
     * The options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Handle the command.
     *
     * @return \Anomaly\NavigationModule\Link\LinkCollection|mixed|null
     */
    public function handle()
    {
        if ($this->group) {
            $links = $this->group->getLinks();
        } else {
            $links = $this->options->get('links');
        }

        if (!$links) {
            return null;
        }

        if ($root = $this->options->get('root')) {
            if ($link = $this->dispatch(new GetParentLink($root, $links))) {
                $this->options->put('parent', $link);
            }
        }

        $this->dispatch(new RemoveRestrictedLinks($links));
        $this->dispatch(new SetParentRelations($links));
        $this->dispatch(new SetChildrenRelations($links));
        $this->dispatch(new SetCurrentLink($links));
        $this->dispatch(new SetActiveLinks($links));

        return $links;
    }
}
