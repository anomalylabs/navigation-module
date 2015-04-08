<?php namespace Anomaly\NavigationModule\LinkType;

use Anomaly\NavigationModule\LinkType\Contract\LinkTypeExtensionInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class LinkTypeExtension
 *
 * @package Anomaly\NavigationModule\Link
 */
abstract class LinkTypeExtension extends Extension implements LinkTypeExtensionInterface
{
    use DispatchesCommands;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string|null
     */
    protected $searchField = 'title';

    /**
     * @var string
     */
    protected $titleField;

    /**
     * @var string
     */
    protected $descriptionHandler;

    /**
     * @return string
     */
    public function getModel()
    {
        return new $this->model;
    }

    /**
     * @return mixed
     */
    public function getSearchField()
    {
        return $this->searchField;
    }

    /**
     * @return mixed
     */
    public function getTitleField()
    {
        return $this->titleField ?: $this->getSearchField();
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->getNamespace('addon.label');
    }

    /**
     * @return string
     */
    public function getInstructions()
    {
        return $this->getNamespace('addon.instructions');
    }

    /**
     * @return string
     */
    public function getLinkType()
    {
        $segments = explode('.', $this->getProvides());
        return $segments[count($segments) - 1];
    }

    /**
     * @return string
     */
    public function getDescriptionHandler()
    {
        return $this->descriptionHandler;
    }

}