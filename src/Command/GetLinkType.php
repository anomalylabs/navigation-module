<?php namespace Anomaly\NavigationModule\Command;


use Anomaly\NavigationModule\Link\Contract\LinkTypeRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class GetLinkType implements SelfHandling
{
    /**
     * @var
     */
    private $type;

    /**
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @param LinkTypeRepositoryInterface $linkTypes
     * @return \Anomaly\NavigationModule\Link\Contract\LinkTypeExtensionInterface|null
     */
    public function handle(LinkTypeRepositoryInterface $linkTypes)
    {
        return $linkTypes->findByType($this->type);
    }

}