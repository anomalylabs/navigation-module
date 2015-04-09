<?php namespace Anomaly\NavigationModule\LinkType;

use Anomaly\NavigationModule\LinkType\Contract\LinkTypeRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class LinkTypeRepository
 *
 * @package Anomaly\NavigationModule\Link
 */
class LinkTypeRepository implements LinkTypeRepositoryInterface
{

    protected $providesPrefix = 'anomaly.module.navigation::link_type';

    /**
     * @var ExtensionCollection
     */
    private $extensions;

    /**
     * @param ExtensionCollection $extensions
     */
    public function __construct(ExtensionCollection $extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * @return ExtensionCollection
     */
    public function all()
    {
        return $this->extensions->search("{$this->providesPrefix}.*");
    }

    /**
     * @param $type
     * @return ExtensionCollection
     */
    public function findByType($type)
    {
        return $this->extensions->find("{$this->providesPrefix}.{$type}");
    }
}