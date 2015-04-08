<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Group\GroupFormBuilder;
use Anomaly\NavigationModule\Group\Table\GroupTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class GroupsController extends AdminController
{

    public function index(GroupTableBuilder $table)
    {
        return $table->render();
    }

    public function form(GroupFormBuilder $form, $id = null)
    {
        return $form->render($id);
    }

    public function delete(GroupRepositoryInterface $groups, $id = null)
    {
        $groups->delete($id);

        return redirect()->route('admin.navigation.links');
    }
}