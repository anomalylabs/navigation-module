<?php namespace Anomaly\NavigationModule\LinkType;

use Anomaly\Streams\Platform\Addon\AddonPresenter;

/**
 * Class LinkTypePresenter
 * @package Anomaly\NavigationModule\Link
 */
class LinkTypePresenter extends AddonPresenter
{

    public function title()
    {
        return trans($this->object->getProvides() . '.title');
    }

    public function presentUrl()
    {
        return 'llala';
    }

}