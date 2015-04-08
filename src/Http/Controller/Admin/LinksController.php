<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkTypeRepositoryInterface;
use Anomaly\NavigationModule\Link\LinkForm\LinkFormBuilder;
use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Http\Request;

class LinksController extends AdminController
{

    /**
     * @var GroupRepositoryInterface
     */
    private $groups;

    /**
     * @var Request
     */
    private $request;
    /**
     * @var LinkModel
     */
    private $links;

    /**
     * @param Request $request
     * @param GroupRepositoryInterface $groups
     * @param LinkRepositoryInterface $links
     */
    public function __construct(
        Request $request,
        GroupRepositoryInterface $groups,
        LinkRepositoryInterface $links
    )
    {
        $this->groups = $groups;
        $this->request = $request;
        $this->links = $links;
    }

    public function index()
    {
        $id = $this->request->get('id');
        $group = $this->request->get('group');

        $groups = $this->groups->all();

        $currentGroup = $this->groups->active($group);

        if ($id) {
            $link = $this->links->find($id);
            $links = $this->links->findChildren($id, 0, true);
        } elseif ($currentGroup) {
            $links = $this->links->findRootByGroup($currentGroup, 0, true);
        }

        $model = preg_quote(get_class($this->links->getModel()), '\\');

        return view('anomaly.module.navigation::links.index',
            compact('link', 'links', 'groups', 'currentGroup', 'type', 'model')
        );
    }

    public function form(LinkFormBuilder $form, Request $request, $id = null)
    {
        return $request->get('type') ? $form->render($id) : redirect()->back();
    }

    public function search(LinkTypeRepositoryInterface $extensions)
    {
        $results = [];

        $type = $this->request->get('type');
        $query = $this->request->get('q');

        if (($extension = $extensions->findByType($type))) {

            $model = $extension->getModel();

            if ($query) {

                $collection = $model->where($extension->getSearchField(), 'like', "%{$query}%")->take(10)->get();

            } else {

                $collection = $model->take(10)->get();
            }

            $descriptionHandler = $extension->getDescriptionHandler();

            /** @var Model $model */
            foreach ($collection as $entry) {

                $result = [
                    'title' => $entry->{$extension->getTitleField()},
                    'id'    => $entry->id,
                    'type'  => get_class($entry),
                ];

                if ($descriptionHandler) {
                    $result['description'] = app()->call($descriptionHandler, compact('entry', 'extension'));
                }

                $results[] = $result;
            }

        }

        return response()->json(['results' => $results]);
    }

}