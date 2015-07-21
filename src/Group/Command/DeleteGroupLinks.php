<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DeleteGroupLinks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Command
 */
class DeleteGroupLinks implements SelfHandling
{

    /**
     * The group instance.
     *
     * @var GroupInterface
     */
    protected $group;

    /**
     * Create a new DeleteGroupLinks instance.
     *
     * @param GroupInterface $group
     */
    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

    /**
     * Handle the command.
     *
     * @param LinkRepositoryInterface $links
     */
    public function handle(LinkRepositoryInterface $links)
    {
        foreach ($this->group->getLinks() as $link) {
            $links->delete($link);
        }
    }
}
