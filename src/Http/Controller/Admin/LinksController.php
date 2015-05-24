<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Form\LinkFormBuilder;
use Anomaly\NavigationModule\Link\Tree\LinkTreeBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class LinksController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Http\Controller\Admin
 */
class LinksController extends AdminController
{

    /**
     * Return an index of existing links.
     *
     * @param LinkTreeBuilder $tree
     * @param GroupRepositoryInterface $groups
     * @param                          $group
     * @return \Illuminate\Http\Response
     */
    public function index(LinkTreeBuilder $tree, GroupRepositoryInterface $groups, $group)
    {
        $tree->setGroup($groups->findBySlug($group));

        return $tree->render();
    }

    public function create(
        LinkFormBuilder $form,
        GroupRepositoryInterface $groups,
        ExtensionCollection $extensions,
        $group
    ) {
        $form->setGroup($groups->findBySlug($group));

        return $form->render();
    }
}
