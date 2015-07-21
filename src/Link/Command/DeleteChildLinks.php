<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DeleteChildLinks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class DeleteChildLinks implements SelfHandling
{

    /**
     * The link instance.
     *
     * @var LinkInterface
     */
    protected $link;

    /**
     * Create a new DeleteChildLinks instance.
     *
     * @param LinkInterface $link
     */
    public function __construct(LinkInterface $link)
    {
        $this->link = $link;
    }

    /**
     * Handle the command.
     *
     * @param LinkRepositoryInterface $links
     */
    public function handle(LinkRepositoryInterface $links)
    {
        foreach ($this->link->getChildren() as $link) {
            $links->delete($link);
        }
    }
}
