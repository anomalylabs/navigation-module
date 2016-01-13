<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\Command\RenderNavigation;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;
use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class NavigationModulePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'nav_group',
                function ($group, array $parameters = []) {
                    return $this->dispatch(new RenderNavigation((new Collection($parameters))->put('group', $group)));
                },
                [
                    'is_safe' => ['html']
                ]
            ),
            new \Twig_SimpleFunction(
                'nav',
                function ($group = null) {
                    return new PluginCriteria(
                        'render',
                        function (Collection $options) use ($group) {
                            return $this->dispatch(new RenderNavigation($options->put('group', $group)));
                        }
                    );
                },
                [
                    'is_safe' => ['html']
                ]
            )
        ];
    }
}
