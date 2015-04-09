<?php namespace Anomaly\NavigationModule\Link\LinkForm;


use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\LinkType\Contract\LinkTypeRepositoryInterface;
use Illuminate\Http\Request;

class LinkFormFields
{

    public function handle(
        LinkFormBuilder $builder,
        LinkTypeRepositoryInterface $linkTypes,
        GroupRepositoryInterface $groups,
        Request $request
    ) {
        $fields = [];

        if ($extension = $linkTypes->findByType($request->get('type'))) {

            $group = $groups->active($request->get('group'));

            $fields = [
                'group'    => [
                    'accessor' => 'Anomaly\NavigationModule\Link\LinkForm\Accessor\GroupAccessor',
                    'config'   => [
                        'default_value' => function () use ($group) {
                            return $group ? $group->getKey() : null;
                        },
                    ],
                ],
                'title',
                'linkable' => [
                    'label'        => $extension->getLabel(),
                    'instructions' => $extension->getInstructions(),
                    'config'       => [
                        'title_field' => $extension->getTitleField(),
                        'url'         => route(
                            'admin.navigation.link_type.search',
                            ['type' => $extension->getLinkType()]
                        ),
                        'related'     => get_class($extension->getModel()),
                    ],
                ],
                'hidden'
            ];

            $builder->setFormOption(
                'sections',
                [
                    [
                        'title'  => trans(
                            'anomaly.module.navigation::link_type.new_link',
                            ['resource' => trans($extension->getLabel())]
                        ),
                        'fields' => [
                            'title',
                            'linkable',
                            'group',
                            'hidden'
                        ],

                    ]
                ]
            );
        }

        $builder->setFields($fields);
        $builder->setFormOption('eager', ['linkable']);
    }
}