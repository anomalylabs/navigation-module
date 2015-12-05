<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class NavigationModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\NavigationModule\Group\Plugin\GroupPlugin'
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/navigation'                         => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@index',
        'admin/navigation/create'                  => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@create',
        'admin/navigation/edit/{id}'               => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@edit',
        'admin/navigation/links/{group?}'          => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@index',
        'admin/navigation/links/{group}/create'    => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@create',
        'admin/navigation/links/{group}/edit/{id}' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@edit',
        'admin/navigation/links/view/{id}'         => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@view',
        'admin/navigation/links/delete/{id}'       => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@delete',
        'admin/navigation/links/choose/{group}'    => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@choose'
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel'  => 'Anomaly\NavigationModule\Link\LinkModel',
        'Anomaly\Streams\Platform\Model\Navigation\NavigationGroupsEntryModel' => 'Anomaly\NavigationModule\Group\GroupModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface'   => 'Anomaly\NavigationModule\Link\LinkRepository',
        'Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface' => 'Anomaly\NavigationModule\Group\GroupRepository'
    ];

}
