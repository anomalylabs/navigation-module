<?php namespace Anomaly\NavigationModule\Link\LinkForm\Field\Group;


use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;

class GroupFieldOptionsHandler
{

    public function handle(GroupRepositoryInterface $repository)
    {
        $options = [];

        foreach ($repository->all() as $group) {
            $options[$group->getKey()] = $group->title;
        }

        return $options;
    }
}