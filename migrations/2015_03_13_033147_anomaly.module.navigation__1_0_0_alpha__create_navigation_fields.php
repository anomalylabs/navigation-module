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
        'title'     => 'anomaly.field_type.text',
        'linkable'  => 'anomaly.field_type.polymorphic',
        'group'     => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Group\GroupModel'
            ]
        ],
        'scope'     => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'default_value' => 'default',
            ]
        ],
        'slug'      => 'anomaly.field_type.slug',
        'parent_id' => 'anomaly.field_type.integer',
        'left'      => 'anomaly.field_type.integer',
        'right'     => 'anomaly.field_type.integer',
        'depth'     => 'anomaly.field_type.integer',
    ];

}