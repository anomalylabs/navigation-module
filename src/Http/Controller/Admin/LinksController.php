<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Link\Form\LinkEntryFormBuilder;
use Anomaly\NavigationModule\Link\Form\LinkFormBuilder;
use Anomaly\NavigationModule\Link\Tree\LinkTreeBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;

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
     * @param LinkTreeBuilder          $tree
     * @param GroupRepositoryInterface $groups
     * @param                          $group
     * @return \Illuminate\Http\Response
     */
    public function index(
        LinkTreeBuilder $tree,
        GroupRepositoryInterface $groups,
        BreadcrumbCollection $breadcrumbs,
        MessageBag $messages,
        $group = null
    ) {
        if (!$group) {

            $messages->warning('Please choose a group first.');

            return redirect('admin/navigation');
        }

        $tree->setGroup($group = $groups->findBySlug($group));

        $breadcrumbs->add($group->getName());

        return $tree->render();
    }

    /**
     * Return the form for creating a new link.
     *
     * @param LinkFormBuilder          $link
     * @param GroupRepositoryInterface $groups
     * @param ExtensionCollection      $extensions
     * @param                          $group
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        LinkFormBuilder $link,
        LinkEntryFormBuilder $form,
        GroupRepositoryInterface $groups,
        ExtensionCollection $extensions,
        BreadcrumbCollection $breadcrumbs,
        $group
    ) {
        $type = $extensions->get($_GET['link_type']);

        $form->addForm('type', $type->getFormBuilder());
        $form->addForm('link', $link->setType($type)->setGroup($group = $groups->findBySlug($group)));

        $breadcrumbs->add($group->getName(), 'admin/navigation/links/' . $group->getSlug());

        return $form->render();
    }

    /**
     * Return the form for editing an existing link.
     *
     * @param LinkFormBuilder          $link
     * @param GroupRepositoryInterface $groups
     * @param ExtensionCollection      $extensions
     * @param                          $group
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        LinkFormBuilder $link,
        LinkEntryFormBuilder $form,
        LinkRepositoryInterface $links,
        GroupRepositoryInterface $groups,
        BreadcrumbCollection $breadcrumbs,
        $group,
        $id
    ) {
        $entry = $links->find($id);

        $form->addForm('type', $entry->getType()->getFormBuilder()->setEntry($entry->getId()));
        $form->addForm(
            'link',
            $link->setEntry($id)->setType($entry->getType())->setGroup($group = $groups->findBySlug($group))
        );

        $breadcrumbs->add($group->getName(), 'admin/navigation/links/' . $group->getSlug());

        return $form->render();
    }
}
