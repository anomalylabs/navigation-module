<?php namespace Anomaly\NavigationModule\Link\Contract;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface LinkTypeExtensionInterface
 *
 * @package Anomaly\NavigationModule\Link\Contract
 */
interface LinkTypeExtensionInterface extends ExtensionInterface
{

    /**
     * @return Model
     */
    public function getModel();

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @return string
     */
    public function getTitleField();

    /**
     * @return string
     */
    public function getSearchField();

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return string|null
     */
    public function getInstructions();

    /**
     * @return string
     */
    public function getLinkType();

    /**
     * @return string
     */
    public function getDescriptionHandler();

}