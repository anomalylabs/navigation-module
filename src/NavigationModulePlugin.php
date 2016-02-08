<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\Command\GetLinks;
use Anomaly\NavigationModule\Link\Command\RenderNavigation;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCriteria;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Support\Decorator;

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
            ),
            new \Twig_SimpleFunction(
                'menu',
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
            ),
            new \Twig_SimpleFunction(
                'links',
                function ($group = null) {
                    return new PluginCriteria(
                        'get',
                        function (Collection $options) use ($group) {
                            return (new Decorator())->decorate(
                                $this->dispatch(new GetLinks($options->put('group', $group)))
                            );
                        }
                    );
                }
            )
        ];
    }
}
