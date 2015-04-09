<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\Streams\Platform\Entry\EntryPresenter;

class LinkPresenter extends EntryPresenter
{

    public function presentAdminUrl()
    {
        return route(
            'admin.navigation',
            [
                'group' => app('Illuminate\\Http\\Request')->get('group'),
                'id'    => $this->object->id
            ]
        );
    }

    public function presentEditUrl()
    {
        return route(
            'admin.navigation.links.edit',
            [
                'id'    => $this->object->id,
                'group' => app('Illuminate\\Http\\Request')->get('group'),
                'type'  => $this->object->type,
            ]
        );
    }

    public function presentUrl()
    {
        return $this->object->linkable->getUrl();
    }
}