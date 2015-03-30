<?php namespace Anomaly\NavigationModule\Http\Controller\Admin;

use Anomaly\NavigationModule\Command\GetLinkType;
use Anomaly\NavigationModule\Command\GetLinkTypes;
use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkTypeRepositoryInterface;
use Anomaly\NavigationModule\Link\LinkForm\LinkFormBuilder;
use Anomaly\NavigationModule\Link\LinkNodeModel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Model\EloquentCollection;
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
     * @param LinkNodeModel $links
     */
    public function __construct(Request $request, GroupRepositoryInterface $groups, LinkNodeModel $links)
    {
        $this->groups = $groups;
        $this->request = $request;
        $this->links = $links;
    }

    public function index($group = null, $inner = null, $title = null)
    {
        $linkTypes = $this->dispatch(new GetLinkTypes());

        $links = [];

        $groups = $this->groups->all();

        if ($currentGroup = $this->groups->active($group)) {
            /** @var EloquentCollection $links */
            $links = $this->links->where('group_id', $currentGroup->getKey())->get()->toTree();
        }

        return view('anomaly.module.navigation::links.index', compact('links', 'linkTypes', 'groups', 'currentGroup', 'inner', 'title'));
    }

    public function form(LinkFormBuilder $form, $group, $type, $id = null)
    {
        if (!$extension = $this->dispatch(new GetLinkType($type))) {
            return redirect()->back();
        }

        return $form->setGroup($this->groups->active($group))->setExtension($extension)->render($id);
    }

    public function search(LinkTypeRepositoryInterface $extensions, $type = null)
    {
        $results = [];

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