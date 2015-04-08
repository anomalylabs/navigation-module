<?php namespace Anomaly\NavigationModule\Link\Command;


use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class GetChildrenLinks implements SelfHandling
{

    /**
     * @var
     */
    private $link;

    /**
     * @var int
     */
    private $maxDepth;

    public function __construct($link, $maxDepth = 0)
    {
        $this->link = $link;
        $this->maxDepth = $maxDepth;
    }

    public function handle(LinkRepositoryInterface $links)
    {

    }

}