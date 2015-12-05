<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Group\Command\RenderGroup;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

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
                    return $this->dispatch(new RenderGroup($group, $parameters));
                },
                [
                    'is_safe' => ['html']
                ]
            )
        ];
    }
}
