<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleNavigation_1_0_0_alpha_CreateNavigationFields extends Migration
{

    /**
     * Fields
     *
     * @var array
     */
    protected $fields = [
        'title'    => 'anomaly.field_type.text',
        'slug'     => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'title'
            ]
        ],
        'linkable' => 'anomaly.field_type.polymorphic',
        'group'    => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Group\GroupModel'
            ]
        ],
        'parent'   => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Link\LinkModel'
            ]
        ],
        'type'     => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'default_value' => 'url',
            ]
        ],
        'hidden'   => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ]
        ],
        'max_depth' => 'anomaly.field_type.integer'
    ];

}