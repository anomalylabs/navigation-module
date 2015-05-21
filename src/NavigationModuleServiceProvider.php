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
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/navigation'                       => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@index',
        'admin/navigation/create'                => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@create',
        'admin/navigation/edit/{id}'             => 'Anomaly\NavigationModule\Http\Controller\Admin\GroupsController@edit',
        'admin/navigation/ajax/choose_link_type' => 'Anomaly\NavigationModule\Http\Controller\Admin\AjaxController@chooseLinkType'
    ];

}
