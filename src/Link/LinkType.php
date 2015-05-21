<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class LinkType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkType extends Extension
{

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->getNamespace('addon.label');
    }
}
