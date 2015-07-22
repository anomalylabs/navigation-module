<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleNavigation_1_0_0_CreateNavigationFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleNavigation_1_0_0_CreateNavigationFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name'          => 'anomaly.field_type.text',
        'class'         => 'anomaly.field_type.text',
        'description'   => 'anomaly.field_type.textarea',
        'entry'         => 'anomaly.field_type.polymorphic',
        'slug'          => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name'
            ]
        ],
        'group'         => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Group\GroupModel'
            ]
        ],
        'parent'        => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Link\LinkModel'
            ]
        ],
        'allowed_roles' => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related' => 'Anomaly\UsersModule\Role\RoleModel'
            ]
        ],
        'type'          => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'   => 'extension',
                'search' => 'anomaly.module.navigation::link_type.*'
            ]
        ],
        'target'        => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_option' => '_self',
                'options'        => [
                    '_self'  => 'anomaly.module.navigation::field.target.option.self',
                    '_blank' => 'anomaly.module.navigation::field.target.option.blank'
                ]
            ]
        ]
    ];

}
