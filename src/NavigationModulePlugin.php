<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\Command\GetLinks;
use Anomaly\NavigationModule\Link\Command\RenderNavigation;
use Anomaly\NavigationModule\Menu\MenuModel;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Collection;


/**
 * Class NavigationModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
                'menu',
                function ($menu = null) {
                    return (new NavigationModuleCriteria(
                        'render',
                        function (Collection $options) use ($menu) {
                            return dispatch_now(new RenderNavigation($options->put('menu', $menu)));
                        }
                    ))
                        ->setModel(MenuModel::class)
                        ->setCachePrefix('anomaly.module.navigation::menu.render');
                },
                [
                    'is_safe' => ['html'],
                ]
            ),
            new \Twig_SimpleFunction(
                'links',
                function ($menu = null) {
                    return (new NavigationModuleCriteria(
                        'get',
                        function (Collection $options) use ($menu) {
                            return decorate(
                                dispatch_now(new GetLinks($options->put('menu', $menu)))
                            );
                        }
                    ))
                        ->setModel(MenuModel::class)
                        ->setCachePrefix('anomaly.module.navigation::menu.links');
                }
            ),
        ];
    }
}
