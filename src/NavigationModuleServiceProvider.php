<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class NavigationModuleServiceProvider
 *
 * @package Anomaly\NavigationModule
 */
class NavigationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\NavigationModule\NavigationModulePlugin'
    ];

    protected $bindings = [
        'Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface'       => 'Anomaly\NavigationModule\Group\GroupRepository',
        'Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface'         => 'Anomaly\NavigationModule\Link\LinkRepository',
        'Anomaly\NavigationModule\LinkType\Contract\LinkTypeRepositoryInterface' => 'Anomaly\NavigationModule\LinkType\LinkTypeRepository',
    ];

    public function map(Router $router)
    {
        $patterns = [
            'slug'    => '[a-z0-9\\_\\-]+',
            'numeric' => '[\d]+',
        ];

        $router->group(
            [
                'prefix' => 'admin/navigation',
            ],
            function (Router $router) use ($patterns) {

                /**
                 * Links
                 */
                $router->get(
                    '/',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@index',
                        'as'   => 'admin.navigation'
                    ]
                );

                $router->get(
                    'links',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@index',
                        'as'   => 'admin.navigation.links'
                    ]
                );

                $router->any(
                    'links',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@form',
                        'as'   => 'admin.navigation.links.create'
                    ]
                )->where('group', $patterns['slug']);

                $router->any(
                    'links/edit/{id}',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@form',
                        'as'   => 'admin.navigation.links.edit'
                    ]
                )->where('group', $patterns['slug']);

                $router->any(
                    'links/delete/{id}',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@delete',
                        'as'   => 'admin.navigation.links.delete'
                    ]
                )->where('type', $patterns['numeric']);

                $router->any(
                    'link_type/search/{type}',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@search',
                        'as'   => 'admin.navigation.link_type.search'
                    ]
                );

                /**
                 * Groups
                 */
                $router->get(
                    'groups',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@index',
                        'as'   => 'admin.navigation.groups'
                    ]
                );

                $router->any(
                    'groups/create',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@form',
                        'as'   => 'admin.navigation.groups.create'
                    ]
                );

                $router->any(
                    'groups/edit/{id}',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@form',
                        'as'   => 'admin.navigation.groups.edit'
                    ]
                )->where('id', $patterns['numeric']);

                $router->any(
                    'links/delete/{id}',
                    [
                        'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@delete',
                        'as'   => 'admin.navigation.groups.delete'
                    ]
                )->where('id', $patterns['numeric']);
            }
        );
    }
}