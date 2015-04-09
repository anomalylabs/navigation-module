<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class NavigationModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'sitemap';

    /**
     * The sections handler.
     *
     * @var string
     */
    protected $sections = 'Anomaly\NavigationModule\NavigationModuleSections@handle';

}