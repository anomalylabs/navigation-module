<?php namespace Anomaly\NavigationModule\Link\Command;


use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class GetRootLinks implements SelfHandling
{

    /**
     * @var string
     */
    private $group;

    /**
     * @var int
     */
    private $maxDepth;

    /**
     * @param string $group
     * @param int    $maxDepth
     */
    public function __construct($group, $maxDepth = 0)
    {
        $this->group    = $group;
        $this->maxDepth = $maxDepth;
    }

    /**
     * @param LinkRepositoryInterface  $links
     * @param GroupRepositoryInterface $groups
     * @return \Anomaly\Streams\Platform\Model\EloquentCollection|array
     */
    public function handle(LinkRepositoryInterface $links, GroupRepositoryInterface $groups)
    {
        $group = $groups->findBySlug($this->group);

        return $group ? $links->findRootByGroup($group) : [];
    }
}