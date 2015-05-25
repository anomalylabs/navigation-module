<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class SetActiveLinks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class SetActiveLinks implements SelfHandling
{

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new SetActiveLinks instance.
     *
     * @param LinkCollection $links
     */
    public function __construct(LinkCollection $links)
    {
        $this->links = $links;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $current = $this->links->current();

        if (!$current) {
            return;
        }

        $current->setActive(true);

        /* @var LinkInterface $link */
        foreach ($this->links as $link) {
            if ($current->getParentId() == $link->getId()) {
                $link->setActive(true);
            }
        }
    }
}
