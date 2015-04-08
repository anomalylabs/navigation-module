<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleNavigation_1_0_0_alpha_CreateNavigationGroupsStream extends Migration
{

    /**
     * Stream
     *
     * @var array
     */
    protected $stream = [
        'namespace' => 'navigation',
        'slug'      => 'groups',
        'locked'    => true,
    ];

    /**
     * Field assignments
     *
     * @var array
     */
    protected $assignments = [
        'title'     => [
            'required' => true
        ],
        'slug'      => [
            'required' => true,
            'unique'   => true,
        ],
        'max_depth' => []
    ];

}
