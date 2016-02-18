<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Menu\Form\MenuFormBuilder;
use Anomaly\NavigationModule\Menu\Table\MenuTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class MenusController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Http\Controller\Admin
 */
class MenusController extends AdminController
{

    /**
     * Return an index of existing navigation menus.
     *
     * @param MenuTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MenuTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the form for creating a new navigation menu.
     *
     * @param MenuFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(MenuFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return the form for editing an existing navigation menu.
     *
     * @param MenuFormBuilder  $form
     * @param                  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(MenuFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
