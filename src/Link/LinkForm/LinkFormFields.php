<?php namespace Anomaly\NavigationModule\Link\LinkForm;


use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;

class LinkFormFields
{

    public function handle(LinkFormBuilder $builder)
    {
        $extension = $builder->getExtension();

        $builder->setFields([
            'group'    => [
                'accessor' => 'Anomaly\NavigationModule\Link\LinkForm\Accessor\GroupAccessor',
                'config'   => [
                    'default_value' => function(GroupRepositoryInterface $groups) {
                        return $groups->active()->getKey();
                    },
                ],
            ],
            'title',
            'linkable' => [
                'label'        => $extension->getLabel(),
                'instructions' => $extension->getInstructions(),
                'config'       => [
                    'title_field' => $extension->getTitleField(),
                    'url'         => route('admin.navigation.link_type.search', ['type' => $extension->getLinkType()]),
                    'related'     => get_class($extension->getModel()),
                ],
            ],
        ]);

        $builder->setFormOption('sections', [
            [
                'title'  => trans('anomaly.module.navigation::link_type.new_link', ['resource' => trans($extension->getLabel())]),
                'fields' => [
                    'title',
                    'linkable',
                    'group',
                ],

            ]
        ]);

        $builder->setFormOption('eager', ['linkable']);
    }

}