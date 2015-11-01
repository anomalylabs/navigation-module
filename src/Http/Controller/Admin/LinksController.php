<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Link\Entry\EntryFormBuilder;
use Anomaly\NavigationModule\Link\Form\LinkFormBuilder;
use Anomaly\NavigationModule\Link\Tree\LinkTreeBuilder;
use Anomaly\NavigationModule\Link\Type\Contract\LinkTypeInterface;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

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
     * @param null                     $group
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index(LinkTreeBuilder $tree, GroupRepositoryInterface $groups, $group = null)
    {
        if (!$group) {

            $this->messages->warning('Please choose a group first.');

            return $this->response->redirectTo('admin/navigation');
        }

        $tree->setGroup($group = $groups->findBySlug($group));

        $this->breadcrumbs->add($group->getName());

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
            'module::ajax/choose_link_type',
            [
                'link_types' => $extensions->search('anomaly.module.navigation::link_type.*'),
                'group'      => $group
            ]
        );
    }

    /**
     * Return the form for creating a new link.
     *
     * @param LinkFormBuilder          $link
     * @param EntryFormBuilder         $form
     * @param LinkRepositoryInterface  $links
     * @param GroupRepositoryInterface $groups
     * @param ExtensionCollection      $extensions
     * @param                          $group
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        LinkFormBuilder $link,
        EntryFormBuilder $form,
        LinkRepositoryInterface $links,
        GroupRepositoryInterface $groups,
        ExtensionCollection $extensions,
        $group
    ) {
        /* @var LinkTypeInterface $type */
        $type = $extensions->get($_GET['link_type']);

        if ($parent = $links->find($this->request->get('parent'))) {
            $link->setParent($parent);
        }

        $form->addForm('type', $type->builder());
        $form->addForm('link', $link->setType($type)->setGroup($group = $groups->findBySlug($group)));

        $this->breadcrumbs->add($group->getName(), 'admin/navigation/links/' . $group->getSlug());

        return $form->render();
    }

    /**
     * Return the form for editing an existing link.
     *
     * @param LinkFormBuilder          $link
     * @param EntryFormBuilder         $form
     * @param LinkRepositoryInterface  $links
     * @param GroupRepositoryInterface $groups
     * @param                          $group
     * @param                          $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        LinkFormBuilder $link,
        EntryFormBuilder $form,
        LinkRepositoryInterface $links,
        GroupRepositoryInterface $groups,
        $group,
        $id
    ) {
        /* @var LinkInterface $entry */
        $entry = $links->find($id);

        $type = $entry->getType();

        $form->addForm('type', $type->builder()->setEntry($entry->getEntry()->getId()));
        $form->addForm(
            'link',
            $link->setEntry($id)->setType($entry->getType())->setGroup($group = $groups->findBySlug($group))
        );

        $this->breadcrumbs->add($group->getName(), 'admin/navigation/links/' . $group->getSlug());

        return $form->render();
    }

    /**
     * View the link destination.
     *
     * @param LinkRepositoryInterface $links
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(LinkRepositoryInterface $links, $id)
    {
        /* @var LinkInterface $link */
        $link = $links->find($id);

        return $this->response->redirectTo($link->getUrl());
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
        if (!$authorizer->authorize('anomaly.module.navigation::links.delete')) {

            $this->messages->error('streams::message.access_denied');

            return $this->redirect->back();
        }

        $links->delete($links->find($id));

        return $this->redirect->back();
    }
}
