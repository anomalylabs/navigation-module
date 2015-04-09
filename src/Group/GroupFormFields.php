<?php namespace Anomaly\NavigationModule\Group;

/**
 * Class GroupFormFields
 *
 * @package Anomaly\NavigationModule\Group
 */
class GroupFormFields
{

    /**
     * @param GroupFormBuilder $builder
     */
    public function handle(GroupFormBuilder $builder)
    {
        $builder->setFormOption(
            'sections',
            [
                [
                    'title'  => trans('anomaly.module.navigation::button.new_group'),
                    'fields' => [
                        'title',
                        'slug',
                    ],
                ]
            ]
        );
    }
}