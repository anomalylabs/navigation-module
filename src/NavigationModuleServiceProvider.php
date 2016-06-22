<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class NavigationModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
        'Anomaly\NavigationModule\NavigationModulePlugin'
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/navigation'                        => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@index',
        'admin/navigation/choose'                 => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@choose',
        'admin/navigation/create'                 => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@create',
        'admin/navigation/edit/{id}'              => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@edit',
        'admin/navigation/links/{menu?}'          => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@index',
        'admin/navigation/links/{menu}/create'    => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@create',
        'admin/navigation/links/{menu}/edit/{id}' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@edit',
        'admin/navigation/links/{menu}/view/{id}' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@view',
        'admin/navigation/links/delete/{id}'      => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@delete',
        'admin/navigation/links/choose/{menu}'    => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@choose'
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel' => 'Anomaly\NavigationModule\Link\LinkModel',
        'Anomaly\Streams\Platform\Model\Navigation\NavigationMenusEntryModel' => 'Anomaly\NavigationModule\Menu\MenuModel'
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface' => 'Anomaly\NavigationModule\Link\LinkRepository',
        'Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface' => 'Anomaly\NavigationModule\Menu\MenuRepository'
    ];

}
