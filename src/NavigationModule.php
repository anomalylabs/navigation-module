<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class NavigationModule
 *
 * @package Anomaly\NavigationModule
 */
class NavigationModule extends Module
{

    /**
     * @var string
     */
    protected $navigation = 'streams.navigation.structure';

    /**
     * @var string
     */
    protected $sections = 'Anomaly\NavigationModule\NavigationModuleSectionsHandler@handle';

}