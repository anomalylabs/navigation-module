<?php namespace Anomaly\NavigationModule\Link\Contract;


use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

interface LinkTypeRepositoryInterface
{

    /**
     * @return ExtensionCollection
     */
    public function all();

    /**
     * @param string $type
     * @return LinkTypeExtensionInterface|null
     */
    public function findByType($type);

}