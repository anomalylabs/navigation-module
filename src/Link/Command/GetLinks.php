<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Group\Command\GetGroup;
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
     * The options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * The group object.
     *
     * @var GroupInterface
     */
    protected $group;

    /**
     * Create a new GetLinks instance.
     *
     * @param Collection          $options
     * @param GroupInterface|null $group
     */
    public function __construct(Collection $options, GroupInterface $group = null)
    {
        $this->options = $options;
        $this->group   = $group;
    }

    /**
     * Handle the command.
     *
     * @return \Anomaly\NavigationModule\Link\LinkCollection|mixed|null
     */
    public function handle()
    {
        if (!$this->group) {
            $this->group = $this->dispatch(new GetGroup($this->options->get('group')));
        }

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

        // Remove restricted for security purposes.
        $this->dispatch(new RemoveRestrictedLinks($links));

        // Set the relationships manually.
        $this->dispatch(new SetParentRelations($links));
        $this->dispatch(new SetChildrenRelations($links));

        // Flag appropriate links.
        $this->dispatch(new SetCurrentLink($links));
        $this->dispatch(new SetActiveLinks($links));

        return $links;
    }
}
