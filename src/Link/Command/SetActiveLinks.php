<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

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

    use DispatchesJobs;

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
        if (!$current = $this->links->current()) {
            return;
        }

        if (!$current->getParentId()) {
            return;
        }

        /* @var LinkInterface $link */
        foreach ($this->links as $link) {

            /**
             * Already flagged.
             */
            if ($link->isActive() || $link->isCurrent()) {
                continue;
            }

            /**
             * Set active if the direct
             * parent of current link.
             */
            if ($link->getId() == $current->getParentId()) {

                $link->setActive(true);
            }

            /**
             * If the active link is in the children
             * of this link then mark it active too.
             */
            if (!$this->links->children($link)->active()->isEmpty()) {

                $link->setActive(true);

                $this->dispatch(new SetActiveLinks($this->links));
            }
        }
    }
}
