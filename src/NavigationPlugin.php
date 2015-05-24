<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class NavigationPlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationPlugin extends Plugin
{

    /**
     * The plugin functions.
     *
     * @var NavigationPluginFunctions
     */
    protected $functions;

    /**
     * Create a new NavigationPlugin instance.
     *
     * @param NavigationPluginFunctions $functions
     */
    public function __construct(NavigationPluginFunctions $functions)
    {
        $this->functions = $functions;
    }

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('navigation_render', [$this->functions, 'render'], ['is_safe' => ['html']])
        ];
    }
}
