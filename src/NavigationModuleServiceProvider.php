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

    protected $bindings = [
        'Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface'   => 'Anomaly\NavigationModule\Group\GroupRepository',
        'Anomaly\NavigationModule\Link\Contract\LinkTypeRepositoryInterface' => 'Anomaly\NavigationModule\Link\LinkTypeRepository',
    ];

    public function map(Router $router)
    {
        $patterns = [
            'slug'    => '[a-z0-9\\_\\-]+',
            'numeric' => '[\d]+',
        ];

        $router->group([
            'prefix' => 'admin/navigation',
        ], function (Router $router) use ($patterns) {

            /**
             * Links
             */

            $router->get('links/{group?}', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@index',
                'as'   => 'admin.navigation.links'
            ])->where('group', $patterns['slug']);

            $router->any('links/{group}/{type}/{id?}', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@form',
                'as'   => 'admin.navigation.links.create'
            ])->where('group', $patterns['slug'])->where('type', $patterns['slug']);

            $router->any('links/{id}/delete', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@delete',
                'as'   => 'admin.navigation.links.delete'
            ])->where('type', $patterns['numeric']);

            $router->any('link_type/search', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@search',
                'as'   => 'admin.navigation.link_type.search'
            ]);

            /**
             * Groups
             */
            $router->get('groups', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@index',
                'as'   => 'admin.navigation.groups'
            ]);

            $router->any('groups/create', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@form',
                'as'   => 'admin.navigation.groups.create'
            ]);

            $router->any('groups/{id}', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@form',
                'as'   => 'admin.navigation.groups.edit'
            ])->where('id', $patterns['numeric']);

            $router->any('links/{id}/delete', [
                'uses' => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@delete',
                'as'   => 'admin.navigation.groups.delete'
            ])->where('id', $patterns['numeric']);

        });

    }

}