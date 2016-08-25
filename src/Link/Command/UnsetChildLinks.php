<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;


/**
 * Class UnsetChildLinks
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UnsetChildLinks
{

    /**
     * The parent link.
     *
     * @var LinkInterface
     */
    protected $link;

    /**
     * Create a new UnsetChildLinks instance.
     *
     * @param LinkInterface $link
     */
    public function __construct(LinkInterface $link)
    {
        $this->link = $link;
    }

    /**
     * Handle the command.
     */
    public function handle(LinkRepositoryInterface $links)
    {
        /* @var LinkInterface $link */
        foreach ($this->link->getChildren() as $link) {
            $links->save($link->setParentId(null));
        }
    }
}
