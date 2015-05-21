<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AjaxController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Http\Controller\Admin
 */
class AjaxController extends AdminController
{

    /**
     * Return the modal for choosing a link type.
     *
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function chooseLinkType(ExtensionCollection $extensions)
    {
        return view(
            'module::admin/ajax/choose_link_type',
            ['link_types' => $extensions->search('anomaly.module.navigation::link_type.*')]
        );
    }
}
