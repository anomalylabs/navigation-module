<?php namespace Anomaly\NavigationModule\Group\Plugin;

use Anomaly\NavigationModule\Group\Plugin\Command\RenderGroup;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class GroupPlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Plugin
 */
class GroupPlugin extends Plugin
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
