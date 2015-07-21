<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Entry\Form\EntryFormBuilder;
use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Link\Form\LinkFormBuilder;
use Anomaly\NavigationModule\Link\Tree\LinkTreeBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Support\Authorizer;
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

            $messages->warning('anomaly.module.navigation::warning.choose_group_first');

            return redirect('admin/navigation');
        }

        $tree->setGroup($group = $groups->findBySlug($group));

        $breadcrumbs->add($group->getName());

        return $tree->render();
    }

    /**
     * Return the modal for choosing a link type.
     *
     * @param ExtensionCollection $extensions
     * @param string              $group
     * @return \Illuminate\View\View
     */
    public function choose(ExtensionCollection $extensions, $group)
    {
        return view(
            'module::admin/ajax/choose_link_type',
            ['link_types' => $extensions->search('anomaly.module.navigation::link_type.*'), 'group' => $group]
        );
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
        EntryFormBuilder $form,
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
        EntryFormBuilder $form,
        LinkRepositoryInterface $links,
        GroupRepositoryInterface $groups,
        BreadcrumbCollection $breadcrumbs,
        $group,
        $id
    ) {
        $entry = $links->find($id);

        $form->addForm('type', $entry->getType()->getFormBuilder()->setEntry($entry->getEntry()->getId()));
        $form->addForm(
            'link',
            $link->setEntry($id)->setType($entry->getType())->setGroup($group = $groups->findBySlug($group))
        );

        $breadcrumbs->add($group->getName(), 'admin/navigation/links/' . $group->getSlug());

        return $form->render();
    }

    /**
     * Delete a link and go back.
     *
     * @param LinkRepositoryInterface $links
     * @param Authorizer              $authorizer
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(LinkRepositoryInterface $links, Authorizer $authorizer, $id)
    {
        $authorizer->authorize('anomaly.module.navigation::links.delete');

        $links->delete($links->find($id));

        return redirect()->back();
    }
}
