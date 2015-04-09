<?php namespace Anomaly\NavigationModule\Link\Contract;


use Anomaly\Streams\Platform\Model\EloquentCollection;

interface LinkInterface
{

    /**
     * @return LinkInterface
     */
    public function parent();

    /**
     * @return EloquentCollection
     */
    public function ancestors();

    /**
     * @return EloquentCollection
     */
    public function children();

    /**
     * @return int
     */
    public function getKey();

    /**
     * @return int
     */
    public function getMaxDepth();
}